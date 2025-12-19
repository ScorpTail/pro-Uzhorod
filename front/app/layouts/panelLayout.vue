<script setup>
const visible = ref(true);
const { setToken, token } = useAuth();

const links = [
    { name: "Користувачі", link: "/panel/users" },
    { name: "Новини", link: "/panel/news" },
    { name: "Памятки", link: "/panel/attractions" },
    { name: "Послуги", link: "/panel/services" },
];

const logout = async () => {
    try {
        await useFetch("http://localhost/api/v1/auth/logout", {
            method: "POST",
            headers: {
                Authorization: `Bearer ${token.value}`,
            },
        });
        setToken(null);
        isModalOpen.value = false;
    } catch (err) {
        console.error("Logout failed:", err);
    }
};
</script>
<template>
    <div class="fixed top-3 left-3 z-10">
        <Button
            @click="visible = true"
            icon="pi pi-bars"
            rounded
            severity="contrast"
        />
    </div>
    <Drawer v-model:visible="visible" position="left">
        <template #header>
            <div class="flex items-center gap-2">
                <span class="font-bold">Панель Адміністратора</span>
            </div>
        </template>
        <ul class="flex flex-col gap-3">
            <li v-for="link in links">
                <NuxtLink
                    :to="link.link"
                    class="font-medium hover:text-blue-400"
                    >{{ link.name }}</NuxtLink
                >
            </li>
        </ul>
        <template #footer>
            <div class="flex items-center gap-2">
                <NuxtLink to="/">
                    <Button
                        label="На головну"
                        icon="pi pi-home"
                        class="flex-auto"
                        variant="outlined"
                    />
                </NuxtLink>
                <Button
                    @click="logout()"
                    label="Вийти"
                    icon="pi pi-sign-out"
                    class="flex-auto"
                    severity="danger"
                    text
                ></Button>
            </div>
        </template>
    </Drawer>
    <NuxtPage />
</template>
