<script setup>
import { onMounted, ref } from "vue";

definePageMeta({
    layout: "panel-layout",
});

const { token } = useAuth();
const route = useRoute();
const attractionId = route.params.id;

const attractionData = ref({
    name: "",
    short_description: "",
    description: "",
    status: "A",
    location: "",
    entry_fee: "",
    working_days: "",
    start_time: "",
    end_time: "",
    weekend_start_time: "",
    weekend_end_time: "",
});

const loadAttraction = async () => {
    try {
        const { data, error } = await useFetch(
            `http://localhost/admin/attraction/edit/${attractionId}`,
            {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            }
        );

        if (error.value) {
            console.error("Помилка при завантаженні памʼятки:", error.value);
            return;
        }

        if (data.value) {
            const attraction = data.value.attraction || data.value;
            Object.keys(attractionData.value).forEach((key) => {
                attractionData.value[key] = attraction[key] ?? "";
            });
        }
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};

onMounted(loadAttraction);

const updateAttraction = async () => {
    try {
        const payload = {};
        Object.keys(attractionData.value).forEach((key) => {
            const val = attractionData.value[key];
            if (val !== "" && val !== null && val !== undefined) {
                payload[key] = val;
            }
        });

        const { error } = await useFetch(
            `http://localhost/admin/attraction/${attractionId}`,
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: payload,
            }
        );

        if (error.value) {
            console.error("Помилка при оновленні памʼятки:", error.value);
            return;
        }
    } catch (err) {
        console.error("Помилка при оновленні памʼятки:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Редагувати Памʼятку</h2>

            <FloatLabel variant="in" class="w-full!">
                <label>Назва</label>
                <InputText v-model="attractionData.name" class="w-full!" />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label>Короткий опис</label>
                <InputText
                    v-model="attractionData.short_description"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label>Опис</label>
                <Textarea
                    v-model="attractionData.description"
                    rows="6"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label>Локація</label>
                <InputText v-model="attractionData.location" class="w-full!" />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label>Вартість входу</label>
                <InputText v-model="attractionData.entry_fee" class="w-full!" />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label>Робочі дні</label>
                <InputText
                    v-model="attractionData.working_days"
                    class="w-full!"
                />
            </FloatLabel>

            <div class="grid grid-cols-2 gap-3">
                <FloatLabel variant="in" class="w-full!">
                    <label>Початок (будні)</label>
                    <InputText
                        type="time"
                        v-model="attractionData.start_time"
                        class="w-full!"
                    />
                </FloatLabel>

                <FloatLabel variant="in" class="w-full!">
                    <label>Кінець (будні)</label>
                    <InputText
                        type="time"
                        v-model="attractionData.end_time"
                        class="w-full!"
                    />
                </FloatLabel>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <FloatLabel variant="in" class="w-full!">
                    <label>Початок (вихідні)</label>
                    <InputText
                        type="time"
                        v-model="attractionData.weekend_start_time"
                        class="w-full!"
                    />
                </FloatLabel>

                <FloatLabel variant="in" class="w-full!">
                    <label>Кінець (вихідні)</label>
                    <InputText
                        type="time"
                        v-model="attractionData.weekend_end_time"
                        class="w-full!"
                    />
                </FloatLabel>
            </div>

            <Button @click="updateAttraction" severity="warn" label="Оновити" />
        </form>
    </div>
</template>
