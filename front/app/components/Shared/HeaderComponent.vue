<script setup>
const route = useRoute();
const navigationLinks = ref([
  { name: "Головна", link: "/" },
  { name: "Пам'ятки", link: "/attractions" },
  { name: "Про нас", link: "/about" },
  { name: "Послуги", link: "/services" },
  { name: "Новини", link: "/news" },
  { name: "Контакти", link: "/contacts" },
]);
const isRouteActive = (path) => route.fullPath === path;

const scrolledPast = ref(false);

const handleScroll = () => {
  scrolledPast.value = window.scrollY > 20;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>
<template>
  <header
    class="flex items-center w-full justify-between h-16 fixed z-9999 top-0"
    :class="[{ 'top-1 bg-transparent': scrolledPast }, scrolledPast ? 'bg-transparent' : 'bg-white']"
  >
    <div
      class="main-container flex items-center justify-between transition-all duration-300 border border-transparent"
      :class="{ 'max-w-[700px] p-2 bg-white border-gray-200 rounded-3xl shadow-xl': scrolledPast }"
    >
      <NuxtLink to="/" class="flex items-center gap-2">
        <div class="bg-blue p-2 rounded-xl">
          <span class="text-white leading-none uppercase">уж</span>
        </div>
        <div class="flex flex-col gap-1">
          <span class="font-medium text-xl leading-none">Ужгород</span>
          <span class="font-normal text-[14px] leading-none">Міський портал</span>
        </div>
      </NuxtLink>

      <button class="flex md:hidden items-center justify-center h-4 w-4">
        <i class="pi pi-bars text-2xl"></i>
      </button>
      <nav class="hidden md:flex">
        <ul class="flex items-center gap-4">
          <li v-for="link in navigationLinks">
            <NuxtLink
              :to="link.link"
              :class="['hover:text-blue transition-colors duration-300 text-sm', { 'text-blue': isRouteActive(link.link) }]"
              >{{ link.name }}</NuxtLink
            >
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>
