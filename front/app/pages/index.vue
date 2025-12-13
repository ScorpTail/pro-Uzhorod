<script setup>
const aboutInfoBlock = [
  { title: "Популяція", value: "115,000+" },
  { title: "Засновано", value: "872 рік" },
  { title: "Мови", value: "Українська, Угорська" },
  { title: "Регіон", value: "Закарпаття" },
];
</script>
<template>
  <section class="relative w-full h-[500px] pb-8">
    <NuxtImg
      src="images/home/hero.jpg"
      alt="hero"
      format="webp"
      placeholder
      class="aspect-square h-full w-full object-cover object-center rounded-xl brightness-70"
    />
    <div class="absolute top-1/2 left-1/2 z-10 -translate-1/2 flex flex-col items-center justify-center gap-2">
      <h1 class="text-3xl md:text-5xl font-bold text-white text-center">Ласкаво просимо до Ужгорода</h1>
      <p class="text-white text-sm md:text-xl font-medium text-center">
        Серце Закарпаття – місто з багатою історією, різноманітною культурою, та перкрасною природою
      </p>
      <div class="flex items-center gap-4 mt-6">
        <NuxtLink
          to="/news"
          class="text-xs md:text-base text-center font-medium bg-white hover:text-white hover:bg-blue transition-colors duration-300 p-3 rounded-2xl"
          >Переглянути Новини</NuxtLink
        >
        <NuxtLink
          to="/attractions"
          class="text-xs md:text-base text-center font-medium bg-white hover:text-white hover:bg-blue transition-colors duration-300 p-3 rounded-2xl"
          >Переглянути Пам'ятки</NuxtLink
        >
      </div>
    </div>
  </section>
  <section class="py-8">
    <div class="flex flex-col items-center justify-center gap-4">
      <h2 class="font-bold text-xl">Про Ужгород</h2>
      <p class="text-center max-w-[900px] text-slate-600">
        Ужгород — місто на заході України, розташоване на річці Уж. Воно є адміністративним центром Закарпатської області, розташованим поблизу
        кордонів зі Словаччиною та Угорщиною. Місто відоме своїм багатокультурним спадком, історичною архітектурою та знаменитою липовою алеєю.
      </p>
    </div>
    <div>
      <ul>
        <li v-for="item in aboutInfoBlock" class="flex flex-col gap-2 items-center">
          <b class="font-medium">{{ item.value }}</b>
          <span class="text-sm text-slate-600">{{ item.title }}</span>
        </li>
      </ul>
    </div>
  </section>
</template>
