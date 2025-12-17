<script setup>
const visible = ref(true);

const links = [
    { name: "Користувачі", link: "/panel/users" },
    { name: "Новини", link: "/panel/news" },
    { name: "Памятки", link: "/panel/attractions" },
    { name: "Послуги", link: "/panel/services" },
];
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
                <NuxtLink
                    to="/"
                    class="bg-red-500 text-white w-full rounded-xl text-center p-2 font-medium"
                    >Головна</NuxtLink
                >
            </div>
        </template>
    </Drawer>
    <NuxtPage />
</template>
