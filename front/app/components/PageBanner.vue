<script setup>
const { title, description, image } = defineProps({
    title: { type: String, required: true },
    description: { type: String, required: true },
    image: { type: String, required: true },
});
</script>
<template>
    <div
        class="relative h-[200px] flex items-center"
        :class="{ 'bg-blue': !image }"
    >
        <NuxtImg
            v-if="image"
            :src="image"
            alt="banner"
            format="webp"
            placeholder
            class="-z-1 absolute top-0 left-0 w-full h-full object-center object-cover brightness-60"
        />
        <div class="main-container flex flex-col gap-3">
            <h1 class="text-2xl font-bold text-white">{{ title }}</h1>
            <p class="font-medium text-white max-w-[500px]">
                {{ description }}
            </p>
        </div>
    </div>
</template>
