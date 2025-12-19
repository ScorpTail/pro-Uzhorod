<script setup>
import { onMounted, ref } from "vue";

definePageMeta({
    layout: "panel-layout",
});
const { token } = useAuth();
const route = useRoute();
const userId = route.params.id;

const userData = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const loadUser = async () => {
    try {
        const { data, error } = await useFetch(
            `http://localhost/admin/user/edit/${userId}`, // GET для отримання даних
            {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            }
        );

        if (error.value) {
            console.error("Помилка при завантаженні користувача:", error.value);
            return;
        }

        if (data.value) {
            const user = data.value.user || data.value;
            userData.value.name = user.name || "";
            userData.value.email = user.email || "";
            userData.value.password = "";
            userData.value.password_confirmation = "";
        }
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};

onMounted(() => {
    loadUser();
});

const updateUser = async () => {
    try {
        const payload = {};
        Object.keys(userData.value).forEach((key) => {
            const val = userData.value[key];
            if (val !== "" && val !== null && val !== undefined) {
                payload[key] = val;
            }
        });

        const { data, error } = await useFetch(
            `http://localhost/admin/user/${userId}`, // POST для редагування
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
            console.error("Помилка при оновленні користувача:", error.value);
            return;
        }
    } catch (err) {
        console.error("Помилка при оновленні користувача:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Редагувати Користувача</h2>

            <FloatLabel variant="in" class="w-full!">
                <label for="name">Ім'я</label>
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
                <label for="password"
                    >Пароль (залиште порожнім, якщо не змінювати)</label
                >
                <InputText
                    v-model="userData.password"
                    id="password"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="pass_conf">Повторіть пароль</label>
                <InputText
                    v-model="userData.password_confirmation"
                    id="pass_conf"
                    class="w-full!"
                />
            </FloatLabel>

            <Button @click="updateUser" severity="warn" label="Оновити" />
        </form>
    </div>
</template>
