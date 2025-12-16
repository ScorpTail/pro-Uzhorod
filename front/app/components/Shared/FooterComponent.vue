<script setup>
const navLinks = [
  { name: "Про місто", link: "/about" },
  { name: "Послуги", link: "/services" },
  { name: "Памятки", link: "/attractions" },
  { name: "Новини", link: "/news" },
];
const soicalLinks = [
  { icon: "pi-instagram", link: "https://www.instagram.com/" },
  { icon: "pi-telegram", link: "https://web.telegram.org/a/" },
  { icon: "pi-facebook", link: "https://www.facebook.com/?locale=uk_UA" },
];
</script>
<template>
  <footer class="bg-dark-blue flex flex-col gap-4 py-4">
    <div class="main-container flex items-start justify-between">
      <div class="flex flex-col gap-2">
        <NuxtLink to="/" class="flex items-center gap-2">
          <div class="bg-blue p-2 rounded-xl">
            <span class="text-white leading-none uppercase">уж</span>
          </div>
          <div class="flex flex-col gap-1 text-white">
            <span class="font-medium text-xl leading-none">Ужгород</span>
            <span class="font-normal text-[14px] leading-none">Міський портал</span>
          </div>
        </NuxtLink>
        <p class="text-white text-sm">Офіційний веб-портал міста Ужгород, Закарпатська область, Україна</p>
      </div>
      <div>
        <span class="text-zinc-200 text-lg font-medium">Швидкі посилання</span>
        <ul>
          <li v-for="link in navLinks">
            <NuxtLink :to="link.link" class="text-zinc-300 text-sm font-normal hover:text-zinc-50 transition-all duration-300">{{
              link.name
            }}</NuxtLink>
          </li>
        </ul>
      </div>
      <div>
        <span class="text-zinc-200 text-lg font-medium">Слідкуйте за нами</span>
        <ul class="flex items-cetner gap-3">
          <li v-for="media in soicalLinks" class="">
            <a target="_blank" :href="media.link" class="text-white"><i :class="`text-2xl text-zinc-300 pi ${media.icon}`"></i></a>
          </li>
        </ul>
      </div>
    </div>
    <hr class="text-gray-700 main-container" />
    <p class="text-white text-center text-sm">© 2025 Uzhorod City Portal. All rights reserved.</p>
  </footer>
</template>
