<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const attractionData = ref({
    name: "",
    description: "",
    short_description: "",
    status: "A",
    location: "",
    entry_fee: "",
    working_days: "",
    start_time: "",
    end_time: "",
    weekend_start_time: "",
    weekend_end_time: "",
});

const createAttraction = async () => {
    try {
        const { data, error, status } = await useFetch(
            "http://localhost/admin/attraction",
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: attractionData.value,
            }
        );

        if (error.value) {
            console.error("Помилка при створенні атракції:", error.value);
            return;
        }

        // Очищення форми після успішного створення
        attractionData.value = {
            name: "",
            description: "",
            short_description: "",
            status: "A",
            location: "",
            entry_fee: "",
            working_days: "",
            start_time: "",
            end_time: "",
            weekend_start_time: "",
            weekend_end_time: "",
        };
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Створити Памятку</h2>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_name">Назва</label>
                <InputText
                    v-model="attractionData.name"
                    id="attraction_name"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_short_desc">Короткий опис</label>
                <InputText
                    v-model="attractionData.short_description"
                    id="attraction_short_desc"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_desc">Опис</label>
                <Textarea
                    v-model="attractionData.description"
                    id="attraction_desc"
                    rows="6"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_location">Локація</label>
                <InputText
                    v-model="attractionData.location"
                    id="attraction_location"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_entry_fee">Вартість входу</label>
                <InputText
                    v-model="attractionData.entry_fee"
                    id="attraction_entry_fee"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_working_days">Робочі дні</label>
                <InputText
                    v-model="attractionData.working_days"
                    id="attraction_working_days"
                    placeholder="Наприклад: Пн-Пт"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_start_time"
                    >Час початку роботи (будні)</label
                >
                <InputText
                    v-model="attractionData.start_time"
                    id="attraction_start_time"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_end_time"
                    >Час завершення роботи (будні)</label
                >
                <InputText
                    v-model="attractionData.end_time"
                    id="attraction_end_time"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_weekend_start"
                    >Час початку роботи (вихідні)</label
                >
                <InputText
                    v-model="attractionData.weekend_start_time"
                    id="attraction_weekend_start"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="attraction_weekend_end"
                    >Час завершення роботи (вихідні)</label
                >
                <InputText
                    v-model="attractionData.weekend_end_time"
                    id="attraction_weekend_end"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <Button @click="createAttraction" label="Створити" />
        </form>
    </div>
</template>
