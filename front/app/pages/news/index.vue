<script setup>
const { data } = await useFetch(`http://localhost/api/v1/news`);

const featureNews = computed(() =>
    data.value.news ? data.value.news.slice(3, 6) : []
);
</script>
<template>
    <section class="my-20 flex flex-col gap-9">
        <PageBanner
            title="Новини та оновлення"
            description="Stay informed about the latest developments, events, and announcements from the city of Uzhorod."
            image="/images/home/castlle.jpg"
        />

        <div class="main-container flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-2xl font-normal">Особливі новини</span>
                <p class="text-gray-600 text-sm font-medium">
                    Всього {{ data.news.length }} Новин
                </p>
            </div>
            <ul class="flex flex-wrap md:flex-nowrap gap-6">
                <li v-for="item in featureNews" class="md:w-1/3">
                    <div
                        class="border border-gray-300 rounded-xl hover:shadow-2xl transition-all"
                    >
                        <div class="w-full h-[250px] bg-light-blue"></div>
                        <div class="p-4 flex flex-col gap-3">
                            <span
                                class="text-xl line-clamp-2 font-medium w-full"
                            >
                                {{ item.title }}
                            </span>
                            <p class="text-gray-700">
                                {{ item.content }}
                            </p>
                            <ClientOnly>
                                <div class="flex items-center gap-2">
                                    <i class="pi pi-calendar"></i>
                                    <NuxtTime>
                                        {{ item.created_at }}
                                    </NuxtTime>
                                </div>
                            </ClientOnly>
                            <div class="">
                                <i class="pi pi-eye"></i> {{ item.views }}
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="main-container flex flex-col gap-4">
            <span class="text-2xl font-normal">Всі новини</span>
            <ul class="flex flex-col gap-5">
                <li v-for="item in data.news">
                    <div
                        class="flex items-center gap-4 border border-gray-300 rounded-xl h-[200px] hover:shadow-2xl transition-all"
                    >
                        <div
                            class="w-full max-w-[200px] h-full bg-light-blue rounded-l-xl flex shrink-0"
                        ></div>
                        <div class="flex flex-col gap-3 py-6">
                            <span class="text-2xl font-normal line-clamp-1">
                                {{ item.title }}
                            </span>
                            <p class="line-clamp-1">{{ item.content }}</p>
                            <div class="flex items-center gap-4">
                                <ClientOnly>
                                    <div class="flex items-center gap-2">
                                        <i class="pi pi-calendar"></i>
                                        <NuxtTime>
                                            {{ item.created_at }}
                                        </NuxtTime>
                                    </div>
                                </ClientOnly>
                                <div class="">
                                    <i class="pi pi-eye"></i> {{ item.views }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
</template>
