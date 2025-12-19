<script setup>
import { onMounted, ref } from "vue";

definePageMeta({
    layout: "panel-layout",
});

const { token } = useAuth();
const route = useRoute();
const newsId = route.params.id;

const newsData = ref({
    title: "",
    short_description: "",
    content: "",
    status: "A",
});

const loadNews = async () => {
    try {
        const { data, error } = await useFetch(
            `http://localhost/admin/news/edit/${newsId}`, // якщо сервер підтримує
            {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            }
        );

        if (error.value) {
            console.error("Помилка при завантаженні новини:", error.value);
            return;
        }

        if (data.value) {
            const news = data.value.news || data.value;
            newsData.value.title = news.title || "";
            newsData.value.short_description = news.short_description || "";
            newsData.value.content = news.content || "";
            newsData.value.status = news.status || "A";
        }
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};

onMounted(() => {
    loadNews();
});

// Функція для оновлення новини
const updateNews = async () => {
    try {
        const payload = {};
        Object.keys(newsData.value).forEach((key) => {
            const val = newsData.value[key];
            if (val !== "" && val !== null && val !== undefined) {
                payload[key] = val;
            }
        });

        const { data, error } = await useFetch(
            `http://localhost/admin/news/${newsId}`,
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: payload,
            }
        );

        if (error.value) {
            console.error("Помилка при оновленні новини:", error.value);
            return;
        }
    } catch (err) {
        console.error("Помилка при оновленні новини:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Редагувати Новину</h2>

            <FloatLabel variant="in" class="w-full!">
                <label for="news_title">Заголовок</label>
                <InputText
                    v-model="newsData.title"
                    id="news_title"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="news_short_desc">Короткий опис</label>
                <InputText
                    v-model="newsData.short_description"
                    id="news_short_desc"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="news_content">Контент</label>
                <Textarea
                    v-model="newsData.content"
                    id="news_content"
                    rows="6"
                    class="w-full!"
                />
            </FloatLabel>

            <Button @click="updateNews" severity="warn" label="Оновити" />
        </form>
    </div>
</template>
