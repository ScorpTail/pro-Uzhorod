<script setup>
const aboutInfoBlock = [
    { title: "Популяція", value: "115,000+", icon: "pi-users" },
    { title: "Засновано", value: "872 рік", icon: "pi-calendar" },
    { title: "Мови", value: "Українська, Угорська", icon: "pi-globe" },
    { title: "Регіон", value: "Закарпаття", icon: "pi-map-marker" },
];
const services = [
    {
        title: "Міська адміністрація",
        description:
            "Отримайте доступ до інформації міської ради, офіційних документів та адміністративних послуг.",
        link: "#",
        icon: "pi-home",
    },
    {
        title: "Громадський транспорт",
        description:
            "Перегляньте маршрути автобусів, розклади та інформацію про транспорт у місті.",
        link: "#",
        icon: "pi-truck",
    },
    {
        title: "Охорона здоров'я",
        description:
            "Знайдіть інформацію про лікарні, клініки та медичні послуги в Ужгороді.",
        link: "#",
        icon: "pi-heart",
    },
    {
        title: "Освіта",
        description: "Школи, університети та навчальні заклади в регіоні.",
        link: "#",
        icon: "pi-graduation-cap",
    },
    {
        title: "Документи та дозволи",
        description:
            "Подайте заявку на отримання дозволів, ліцензій та офіційних документів в режимі онлайн.",
        link: "#",
        icon: "pi-file-check",
    },
    {
        title: "Культурні центри",
        description: "Музеї, театри, бібліотеки та культурні події в місті.",
        link: "#",
        icon: "pi-building-columns",
    },
];

const attractions = [
    {
        image: "images/home/castlle.jpg",
        title: "Uzhorod Castle",
        description:
            "A medieval castle dating back to the 9th century, now housing the Zakarpattia Museum of Regional History.",
    },
    {
        image: "images/home/castlle.jpg",
        title: "Uzhorod Castle",
        description:
            "A medieval castle dating back to the 9th century, now housing the Zakarpattia Museum of Regional History.",
    },
    {
        image: "images/home/castlle.jpg",
        title: "Uzhorod Castle",
        description:
            "A medieval castle dating back to the 9th century, now housing the Zakarpattia Museum of Regional History.",
    },
    {
        image: "images/home/castlle.jpg",
        title: "Uzhorod Castle",
        description:
            "A medieval castle dating back to the 9th century, now housing the Zakarpattia Museum of Regional History.",
    },
];

const news = [
    {
        title: "Annual Uzhorod Wine Festival Announced",
        description:
            "The city will host its traditional wine festival celebrating Zakarpattia's winemaking heritage.",
        link: "#",
        tag: "events",
        date: "12-12-2025",
    },
    {
        title: "Annual Uzhorod Wine Festival Announced",
        description:
            "The city will host its traditional wine festival celebrating Zakarpattia's winemaking heritage.",
        link: "#",
        tag: "events",
        date: "12-12-2025",
    },
    {
        title: "Annual Uzhorod Wine Festival Announced",
        description:
            "The city will host its traditional wine festival celebrating Zakarpattia's winemaking heritage.",
        link: "#",
        tag: "events",
        date: "12-12-2025",
    },
    {
        title: "Annual Uzhorod Wine Festival Announced",
        description:
            "The city will host its traditional wine festival celebrating Zakarpattia's winemaking heritage.",
        link: "#",
        tag: "events",
        date: "12-12-2025",
    },
];
const { data } = await useFetch(`http://localhost/api/v1/news`);

const featureNews = computed(() =>
    data.value.news ? data.value.news.slice(3, 7) : []
);
</script>
<template>
    <section class="relative w-full h-[500px] mt-16">
        <NuxtImg
            src="images/home/hero.jpg"
            alt="hero"
            format="webp"
            placeholder
            class="aspect-square h-full w-full object-cover object-center rounded-xl brightness-70"
        />
        <div
            class="absolute top-1/2 left-1/2 z-10 -translate-1/2 flex flex-col items-center justify-center gap-2"
        >
            <h1 class="text-3xl md:text-5xl font-bold text-white text-center">
                Ласкаво просимо до Ужгорода
            </h1>
            <p class="text-white text-sm md:text-xl font-medium text-center">
                Серце Закарпаття – місто з багатою історією, різноманітною
                культурою, та перкрасною природою
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
    <section class="py-8 flex flex-col gap-10 bg-thin-blue">
        <div
            class="flex flex-col items-center justify-center gap-4 main-container"
        >
            <h2 class="heading-2">Про Ужгород</h2>
            <p class="text-center max-w-[900px] text-slate-600">
                Ужгород — місто на заході України, розташоване на річці Уж. Воно
                є адміністративним центром Закарпатської області, розташованим
                поблизу кордонів зі Словаччиною та Угорщиною. Місто відоме своїм
                багатокультурним спадком, історичною архітектурою та знаменитою
                липовою алеєю.
            </p>
        </div>
        <div class="main-container">
            <ul
                class="w-full flex items-center justify-between gap-2 flex-wrap"
            >
                <li
                    v-for="item in aboutInfoBlock"
                    class="w-full sm:w-[49%] lg:w-[23%] flex flex-col gap-6 items-center border border-slate-200 bg-white rounded-2xl py-9"
                >
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-light-blue rounded-full"
                    >
                        <i :class="`pi ${item.icon} text-blue `"></i>
                    </div>
                    <b class="font-medium">{{ item.value }}</b>
                    <span class="text-sm text-slate-600">{{ item.title }}</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="w-full main-container bg-white py-8 flex flex-col gap-9">
        <div
            class="flex flex-col items-center justify-center gap-4 main-container"
        >
            <h2 class="heading-2">Міські служби</h2>
            <p class="text-center max-w-[900px] text-slate-600">
                Доступ до основних міських послуг та інформації для мешканців і
                відвідувачів
            </p>
        </div>
        <ul class="flex flex-wrap gap-3">
            <li
                v-for="item in services"
                class="w-full md:w-[48%] lg:w-[32%] p-6 border border-slate-200 rounded-2xl"
            >
                <div class="flex items-start gap-2">
                    <span
                        class="bg-light-blue w-12 h-12 flex shrink-0 items-center justify-center rounded-xl"
                    >
                        <i
                            :class="`pi ${item.icon} text-blue text-xl leading-none`"
                        ></i>
                    </span>
                    <div class="flex flex-col gap-1">
                        <h4 class="text-lg font-medium">
                            {{ item.title }}
                        </h4>
                        <p class="text-sm font-light">
                            {{ item.description }}
                        </p>
                        <NuxtLink
                            :to="item.link"
                            class="group text-blue hover:underline underline-offset-2 mt-3 font-medium text-sm"
                            >Дивитися більше
                            <i
                                class="ml-2 pi pi-arrow-right text-sm group-hover:-rotate-45 transition-all duration-300"
                            ></i>
                        </NuxtLink>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <section
        class="bg-thin-blue flex flex-col items-center justify-center gap-9 p-9"
    >
        <div
            class="flex flex-col items-center justify-center gap-4 main-container"
        >
            <h2 class="heading-2">Найкращі памятки</h2>
            <p class="text-center max-w-[900px] text-slate-600">
                Відкрийте для себе найвідоміші пам'ятки та найкрасивіші місця
                Ужгорода
            </p>
        </div>
        <ul class="flex items-center flex-wrap gap-4 main-container">
            <li
                v-for="item in attractions"
                class="w-full md:w-[48%] border border-slate-200 rounded-2xl"
            >
                <article class="w-full flex flex-col gap-4">
                    <div class="w-full h-[200px] md:h-[300px]">
                        <NuxtImg
                            :src="item.image"
                            alt="test"
                            fomat="webp"
                            placeholder
                            loading="lazy"
                            class="w-full h-full object-cover object-center rounded-t-2xl"
                        />
                    </div>
                    <div class="p-6">
                        <span class="text-xl font-medium">{{
                            item.title
                        }}</span>
                        <p class="text-sm">{{ item.description }}</p>
                    </div>
                </article>
            </li>
        </ul>
    </section>
    <section class="flex flex-col gap-9 p-9 main-container">
        <div class="flex flex-col gap-4 items-center justify-center">
            <h2 class="heading-2">Останні новини</h2>
            <p class="text-center max-w-[900px] text-slate-600">
                Будьте в курсі останніх новин та оголошень з Ужгорода
            </p>
        </div>
        <ul class="flex flex-wrap gap-4">
            <li
                v-for="item in featureNews"
                class="w-full md:w-[48%] border border-slate-200 rounded-2xl"
            >
                <article class="flex flex-col gap-6 p-4">
                    <div class="flex items-center gap-2">
                        <span
                            class="capitalize text-xs bg-slate-200 px-1.5 py-0.5 font-medium rounded-lg"
                            >events</span
                        >
                    </div>
                    <span>{{ item.title }}</span>
                    <p class="text-sm font-light">{{ item.description }}</p>
                    <NuxtLink
                        to="/news"
                        class="text-center group text-blue hover:underline underline-offset-2 mt-3 font-medium text-sm"
                        >Дивитися більше
                        <i
                            class="ml-2 pi pi-arrow-right text-sm group-hover:-rotate-45 transition-all duration-300"
                        ></i>
                    </NuxtLink>
                </article>
            </li>
        </ul>
        <NuxtLink
            to="/news"
            class="border border-slate-200 self-center px-3 py-1.5 rounded-xl font-medium text-sm hover:bg-slate-200 transition-all duration-300"
            >Дивитися всі Новини</NuxtLink
        >
    </section>
</template>
