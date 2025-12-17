<script setup>
const mainOficeInfo = [
    {
        icon: "pi-map-marker",
        title: "Народна площа 3",
        text: "Uzhorod, 88000 Zakarpattia Oblast, Ukraine",
    },
    {
        icon: "pi-phone",
        title: "+380 (312) 61-27-43",
        text: "Main Reception",
    },
    {
        icon: "pi-envelope",
        title: "info@uzhorod-city.gov.ua",
        text: "General Inquiries",
    },
    {
        icon: "pi-clock",
        title: "Monday - Friday",
        text: "9:00 AM - 6:00 PM",
    },
];
const socialMedia = [
    {
        icon: "pi-facebook",
        title: "Facebook",
        link: "https://www.facebook.com/?locale=uk_UA",
    },
    {
        icon: "pi-twitter",
        title: "Twiter",
        link: "https://www.facebook.com/?locale=uk_UA",
    },
    {
        icon: "pi-instagram",
        title: "Instagram",
        link: "https://www.facebook.com/?locale=uk_UA",
    },
    {
        title: "YouTube",
        icon: "pi-youtube",
        link: "https://www.facebook.com/?locale=uk_UA",
    },
];

const departmentContacts = [
    {
        title: "City Administration",
        phone: "+380 (312) 61-27-43",
        email: "admin@uzhorod-city.gov.ua",
        address: "Narodna Square, 3",
        time: "Mon-Fri: 9:00-18:00",
    },
    {
        title: "City Administration",
        phone: "+380 (312) 61-27-43",
        email: "admin@uzhorod-city.gov.ua",
        address: "Narodna Square, 3",
        time: "Mon-Fri: 9:00-18:00",
    },
    {
        title: "City Administration",
        phone: "+380 (312) 61-27-43",
        email: "admin@uzhorod-city.gov.ua",
        address: "Narodna Square, 3",
        time: "Mon-Fri: 9:00-18:00",
    },
    {
        title: "City Administration",
        phone: "+380 (312) 61-27-43",
        email: "admin@uzhorod-city.gov.ua",
        address: "Narodna Square, 3",
        time: "Mon-Fri: 9:00-18:00",
    },
];
</script>
<template>
    <section class="mt-16">
        <PageBanner
            title="Звяжіться з нами"
            description="Зв'яжіться з міськими департаментами, надішліть запити або знайдіть інформацію про те, як з нами зв'язатися."
            image="/images/home/hero.jpg"
        />
        <div
            class="main-container mt-20 flex flex-col lg:flex-row items-start gap-5"
        >
            <form
                @submit.prevent
                class="w-full border border-gray-300 rounded-2xl p-4 flex flex-col gap-3"
            >
                <span class="text-2xl font-medium">
                    Наділіть нам повідомлення
                </span>
                <p class="text-stone-500 text-sm">
                    Заповніть форму нижче, і ми зв'яжемося з вами якомога
                    швидше.
                </p>
                <div class="flex flex-wrap gap-4 justify-between">
                    <FloatLabel variant="in" class="w-[48%]">
                        <label for="first_name">Імя</label>
                        <InputText id="first_name" class="w-full" />
                    </FloatLabel>
                    <FloatLabel variant="in" class="w-[48%]">
                        <label for="last_name">Прізвище</label>
                        <InputText id="last_name" class="w-full" />
                    </FloatLabel>
                    <FloatLabel variant="in" class="w-[48%]">
                        <label for="email">Email</label>
                        <InputText id="email" type="email" class="w-full" />
                    </FloatLabel>
                    <FloatLabel variant="in" class="w-[48%]">
                        <label for="phone">Номер телефону</label>
                        <InputText id="phone" type="tel" class="w-full" />
                    </FloatLabel>
                </div>
                <FloatLabel variant="in" class="w-full">
                    <label for="subject">Тема</label>
                    <InputText id="subject" type="text" class="w-full" />
                </FloatLabel>
                <FloatLabel variant="in" class="w-full">
                    <label for="message">Повідомлення</label>
                    <InputText id="message" type="text" class="w-full" />
                </FloatLabel>
                <Button icon="pi pi-send" severity="contrast" label="Надіслати">
                </Button>
            </form>
            <div class="w-full lg:max-w-[400px] flex lg:flex-col gap-5">
                <div
                    class="w-full border border-gray-300 rounded-xl p-4 flex flex-col gap-4"
                >
                    <span class="text-lg font-medium">
                        <i class="text-lg! pi pi-building"></i>
                        Головний офіс
                    </span>
                    <ul class="flex flex-col gap-4">
                        <li
                            v-for="item in mainOficeInfo"
                            class="flex items-start gap-3"
                        >
                            <i
                                :class="[
                                    'text-blue text-lg leading-none pi',
                                    item.icon,
                                ]"
                            ></i>
                            <div class="flex flex-col gap-1">
                                <span class="leading-none font-medium">
                                    {{ item.title }}</span
                                >
                                <span
                                    class="text-stone-600 max-w-[200px] text-sm"
                                >
                                    {{ item.text }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div
                    class="w-full h-max border border-gray-300 rounded-xl p-4 flex flex-col gap-4"
                >
                    <div class="text-lg font-medium">
                        <li class="pi pi-hashtag"></li>
                        Підпишіться на нас
                    </div>
                    <ul
                        class="flex items-center flex-wrap justify-between gap-1"
                    >
                        <li
                            v-for="item in socialMedia"
                            class="w-[49%] border border-gray-300 px-2 py-1 rounded-xl hover:bg-gray-100"
                        >
                            <a
                                :href="item.link"
                                class="flex items-center gap-2"
                            >
                                <i :class="['pi', item.icon]"></i>
                                <span class="text-sm font-medium">
                                    {{ item.title }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-container flex flex-col gap-5 py-20">
            <span class="text-2xl font-medium">Контакти відділу</span>
            <ul class="flex flex-wrap justify-between gap-4 items-center">
                <li
                    v-for="item in departmentContacts"
                    class="flex flex-col gap-2 w-full lg:w-[48%] border border-gray-300 rounded-xl p-4"
                >
                    <span class="font-medium text-xl">{{ item.title }}</span>
                    <a
                        :href="`tel:${item.phone}`"
                        class="flex items-center gap-4 text-sm"
                    >
                        Номер телефону: {{ item.phone }}
                    </a>
                    <a
                        :href="`mailto:${item.email}`"
                        class="flex items-center gap-4 text-sm"
                    >
                         Пошта: {{ item.email }}
                    </a>
                    <p class="flex items-center gap-4 text-sm">
                        Адреса: {{ item.address }}
                    </p>
                    <p class="flex items-center gap-4 text-sm">
                        Графік: {{ item.time }}
                    </p>
                </li>
            </ul>
        </div>
    </section>
</template>
