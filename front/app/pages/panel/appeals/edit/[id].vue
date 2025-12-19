<script setup>
import { onMounted, ref } from "vue";

definePageMeta({
    layout: "panel-layout",
});

const { token } = useAuth();
const route = useRoute();
const appealId = route.params.id;

const appealData = ref({
    name: "",
    surname: "",
    lastname: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
});

// Завантаження appeal
const loadAppeal = async () => {
    const { data, error } = await useFetch(
        `http://localhost/admin/appeal/edit/${appealId}`,
        {
            headers: {
                Authorization: `Bearer ${token.value}`,
            },
        }
    );

    if (error.value) {
        console.error("Помилка при завантаженні звернення:", error.value);
        return;
    }

    if (data.value) {
        const appeal = data.value.appeal ?? data.value;

        appealData.value = {
            name: appeal.name ?? "",
            surname: appeal.surname ?? "",
            lastname: appeal.lastname ?? "",
            email: appeal.email ?? "",
            phone: appeal.phone ?? "",
            subject: appeal.title ?? "",
            message: appeal.content ?? "",
        };
    }
};

onMounted(loadAppeal);

// Оновлення appeal
const updateAppeal = async () => {
    const payload = {
        title: appealData.value.subject,
        content: appealData.value.message,
    };

    const { error } = await useFetch(
        `http://localhost/admin/appeal/${appealId}`,
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
        console.error("Помилка при оновленні звернення:", error.value);
        return;
    }

    console.log("Звернення оновлено");
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Редагувати звернення</h2>

            <FloatLabel variant="in" class="w-full!">
                <label for="subject">Тема</label>
                <InputText
                    class="w-full!"
                    v-model="appealData.subject"
                    id="subject"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="message">Повідомлення</label>
                <Textarea
                    class="w-full!"
                    v-model="appealData.message"
                    id="message"
                    rows="6"
                />
            </FloatLabel>

            <Button
                @click="updateAppeal"
                severity="warn"
                label="Оновити звернення"
            />
        </form>
    </div>
</template>
