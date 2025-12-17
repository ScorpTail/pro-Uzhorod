<script setup>
const factsBlock = [
    {
        icon: "pi-users",
        title: "Мультикультурна спадщина",
        description:
            "Ужгород є домом для різноманітного населення, що включає українців, угорців, словаків, румунів та інші етнічні групи, створюючи унікальну культурну мозаїку.",
    },
    {
        icon: "pi-map-marker",
        title: "Стратегічне розташування",
        description:
            "Розташоване на перехресті Центральної Європи, місто Ужгород межує зі Словаччиною і знаходиться недалеко від Угорщини, Румунії та Польщі.",
    },
    {
        icon: "pi-building-columns",
        title: "Культурний капітал",
        description:
            "Місто, в якому розташовано безліч музеїв, театрів, університетів та культурних установ, що зберігають і популяризують багату спадщину регіону.",
    },
    {
        icon: "pi-arrow-up-right",
        title: "Економічний центр",
        description:
            "Зростаючий центр торгівлі, туризму та транскордонного співробітництва з розвиненою інфраструктурою та бізнес-можливостями.",
    },
];

const labels = [
    { icon: "pi-users", title: "Total Population", value: "115,000" },
    { icon: "pi-map-marker", title: "Area", value: "41.6 km²" },
    { icon: "pi-calendar", title: "Founded", value: "9th Century" },
    { icon: "pi-bookmark", title: "Status", value: "Regional Center" },
];
</script>
<template>
    <section class="mt-20 bg-gray-50">
        <PageBanner
            title="Про Ужгород"
            description="Відкрийте для себе багату історію, культуру та яскраве суспільство Ужгорода, адміністративного центру Закарпатської області на заході України."
        />
        <div class="main-container flex flex-col gap-10 py-10">
            <ul
                class="flex items-center justify-between gap-3 overflow-x-auto w-full"
            >
                <li
                    v-for="item in labels"
                    class="border border-gray-300 w-full rounded-xl p-4 bg-white flex items-center gap-4"
                >
                    <span
                        class="bg-light-blue w-10 h-10 flex shrink-0 items-center justify-center rounded-xl"
                    >
                        <i :class="['pi text-blue text-2xl!', item.icon]"></i>
                    </span>
                    <div class="flex flex-col gap-2">
                        <p class="text-sm text-gray-600 whitespace-nowrap">
                            {{ item.title }}
                        </p>
                        <div class="font-bold text-2xl whitespace-nowrap">
                            {{ item.value }}
                        </div>
                    </div>
                </li>
            </ul>
            <div>
                <h2 class="text-2xl font-medium">Ключові факти</h2>
                <ul class="flex flex-wrap gap-4 justify-between">
                    <li
                        v-for="item in factsBlock"
                        class="w-[48%] border bg-white border-gray-300 rounded-2xl p-4 flex flex-col gap-4"
                    >
                        <div class="flex items-center gap-3">
                            <span
                                class="bg-light-blue w-10 h-10 flex items-center justify-center rounded-xl"
                            >
                                <i
                                    :class="[
                                        'text-blue font-bold text-xl! pi',
                                        item.icon,
                                    ]"
                                ></i>
                            </span>
                            <p class="text-xl">{{ item.title }}</p>
                        </div>
                        <p>{{ item.description }}</p>
                    </li>
                </ul>
            </div>
            <div class="border border-gray-300 rounded-2xl p-4 bg-white">
                <span class="text-xl font-medium">Про місто</span>
                <p class="py-2 text-stone-700">
                    Ужгород — місто на заході України, розташоване на кордоні зі
                    Словаччиною та поблизу кордону з Угорщиною. Це
                    адміністративний центр Закарпатської області та найменша за
                    чисельністю населення обласна столиця України.
                </p>
                <p class="py-2 text-stone-700">
                    Місто відоме своєю добре збереженою архітектурою, зокрема
                    Ужгородським замком, численними церквами та соборами, а
                    також чарівним історичним центром. Липова алея міста, одна з
                    найдовших в Європі, є популярною пам'яткою, особливо під час
                    весняного цвітіння.
                </p>
                <p class="py-2 text-stone-700">
                    Ужгород є важливим культурним і освітнім центром, де
                    розташовано кілька університетів, театрів і музеїв.
                    Унікальне розташування міста зробило його плавильним котлом
                    різних культур і традицій, що відбилося в його архітектурі,
                    кухні та місцевих звичаях.
                </p>
                <p class="py-2 text-stone-700">
                    Сьогодні Ужгород продовжує розвиватися як сучасне
                    європейське місто, зберігаючи при цьому своє багате
                    культурне спадщину і традиції. Місто активно сприяє розвитку
                    туризму, транскордонного співробітництва та програм
                    культурного обміну.
                </p>
            </div>
        </div>
    </section>
</template>
