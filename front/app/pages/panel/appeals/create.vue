<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const appealData = ref({
    name: "",
    surname: "",
    lastname: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
});

const createAttraction = async () => {
    try {
        const { data, error, status } = await useFetch(
            "http://localhost/api/v1/appeal",
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: {
                    name: appealData.value.name,
                    surname: appealData.value.surname,
                    email: appealData.value.email,
                    phone: appealData.value.phone,
                    title: appealData.value.subject,
                    content: appealData.value.message,
                    user_id: "1",
                },
            }
        );

        if (error.value) {
            console.error("Помилка при створенні атракції:", error.value);
            return;
        }

        // Очищення форми після успішного створення
        appealData.value = {
            name: "",
            surname: "",
            lastname: "",
            email: "",
            phone: "",
            subject: "",
            message: "",
        };
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent="createAttraction" class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Створити звернення</h2>

            <FloatLabel variant="in" class="w-full">
                <label for="name">Імʼя</label>
                <InputText v-model="appealData.name" id="name" class="w-full" />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="surname">Прізвище</label>
                <InputText
                    v-model="appealData.surname"
                    id="surname"
                    class="w-full"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="lastname">По батькові</label>
                <InputText
                    v-model="appealData.lastname"
                    id="lastname"
                    class="w-full"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="email">Email</label>
                <InputText
                    v-model="appealData.email"
                    id="email"
                    type="email"
                    class="w-full"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="phone">Телефон</label>
                <InputText
                    v-model="appealData.phone"
                    id="phone"
                    type="tel"
                    class="w-full"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="subject">Тема звернення</label>
                <InputText
                    v-model="appealData.subject"
                    id="subject"
                    class="w-full"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full">
                <label for="message">Текст звернення</label>
                <Textarea
                    v-model="appealData.message"
                    id="message"
                    rows="6"
                    class="w-full"
                />
            </FloatLabel>

            <Button type="submit" label="Надіслати звернення" />
        </form>
    </div>
</template>
