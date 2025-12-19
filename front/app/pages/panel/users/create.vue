<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const userData = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
const createUser = async () => {
    try {
        const { data, error, status } = await useFetch(
            "http://localhost/admin/user",
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: userData.value,
            }
        );

        if (error.value) {
            console.error("Помилка при створенні користувача:", error.value);
            return;
        }

        userData.value = {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        };
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>
<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Створити Користувача</h2>
            <FloatLabel variant="in" class="w-full!">
                <label for="name">Імя</label>
                <InputText v-model="userData.name" id="name" class="w-full!" />
            </FloatLabel>
            <FloatLabel variant="in" class="w-full!">
                <label for="email">Email</label>
                <InputText
                    v-model="userData.email"
                    id="email"
                    class="w-full!"
                />
            </FloatLabel>
            <FloatLabel variant="in" class="w-full!">
                <label for="password">Пароль</label>
                <InputText
                    v-model="userData.password"
                    id="password"
                    class="w-full!"
                />
            </FloatLabel>
            <FloatLabel variant="in" class="w-full!">
                <label for="pass_conf">Повторіть Пароль</label>
                <InputText
                    class="w-full!"
                    v-model="userData.password_confirmation"
                    id="pass_conf"
                />
            </FloatLabel>
            <Button @click="createUser" label="Створити" />
        </form>
    </div>
</template>
