<script setup>
const { data } = await useFetch(`http://localhost/api/v1/attraction`);
</script>
<template>
    <section class="my-20 flex flex-col gap-9 bg-gray-50 relative -z-2">
        <PageBanner
            title="Туристичні визначні пам'ятки"
            description="Відкрийте для себе багату культурну спадщину, історичні пам'ятки та природну красу Ужгорода та його околиць."
            image="/images/home/attractions.jpeg"
        />
        <div class="main-container">
            <ul class="flex flex-wrap gap-5 justify-between">
                <!-- <li v-for="item in data.attractions" class="w-[48%]">
                    <div
                        class="w-full bg-white border border-gray-300 rounded-xl p-4 flex flex-col gap-3 hover:shadow-2xl duration-300"
                    >
                        <span class="text-xl font-medium">
                            {{ item.name }}
                        </span>
                        <p class="text-sm font-gray-500">
                            {{ item.description }}
                        </p>
                        <div class="flex flex-col gap-2">
                            <span
                                class="flex flex-center gap-2 text-sm text-gray-700"
                            >
                                <i class="pi pi-phone"></i>
                                {{ item.phone }}
                            </span>
                            <span
                                class="flex flex-center gap-2 text-sm text-gray-700"
                            >
                                <i class="pi pi-map-marker"></i>
                                {{ item.location }}
                            </span>
                            <span
                                class="flex flex-center gap-2 text-sm text-gray-700"
                            >
                                <i class="pi pi-clock"></i>
                                {{ item.start_work }} – {{ item.end_work }}
                            </span>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div>
    </section>
</template>
