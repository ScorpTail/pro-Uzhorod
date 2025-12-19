<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const newsData = ref({
    title: "",
    short_description: "",
    content: "",
    status: "A",
});

const createNews = async () => {
    try {
        const { data, error, status } = await useFetch(
            "http://localhost/admin/news",
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: newsData.value,
            }
        );

        if (error.value) {
            console.error("Помилка при створенні новини:", error.value);
            return;
        }

        // Очищення форми після успішного створення
        newsData.value = {
            title: "",
            short_description: "",
            content: "",
        };
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Створити Новину</h2>

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

            <Button @click="createNews" label="Створити" />
        </form>
    </div>
</template>
