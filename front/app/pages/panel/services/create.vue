<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const serviceData = ref({
    name: "",
    description: "",
    short_description: "",
    status: "A",
    working_days: "",
    start_work: "",
    end_work: "",
    weekend_start_work: "",
    weekend_end_work: "",
    location: "",
    phone: "",
});

const createService = async () => {
    try {
        const { data, error, status } = await useFetch(
            "http://localhost/admin/service",
            {
                method: "POST",
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    "Content-Type": "application/json",
                },
                body: serviceData.value,
            }
        );

        if (error.value) {
            console.error("Помилка при створенні сервісу:", error.value);
            return;
        }

        // Очищення форми після успішного створення
        serviceData.value = {
            name: "",
            description: "",
            short_description: "",
            status: "A",
            working_days: "",
            start_work: "",
            end_work: "",
            weekend_start_work: "",
            weekend_end_work: "",
            location: "",
            phone: "",
        };
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Створити Сервіс</h2>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_name">Назва</label>
                <InputText
                    v-model="serviceData.name"
                    id="service_name"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_short_desc">Короткий опис</label>
                <InputText
                    v-model="serviceData.short_description"
                    id="service_short_desc"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_desc">Опис</label>
                <Textarea
                    v-model="serviceData.description"
                    id="service_desc"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_working_days">Робочі дні</label>
                <InputText
                    v-model="serviceData.working_days"
                    id="service_working_days"
                    placeholder="Наприклад: Пн-Пт"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_start_work"
                    >Час початку роботи (будні)</label
                >
                <InputText
                    v-model="serviceData.start_work"
                    id="service_start_work"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_end_work"
                    >Час завершення роботи (будні)</label
                >
                <InputText
                    v-model="serviceData.end_work"
                    id="service_end_work"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_weekend_start"
                    >Час початку роботи (вихідні)</label
                >
                <InputText
                    v-model="serviceData.weekend_start_work"
                    id="service_weekend_start"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_weekend_end"
                    >Час завершення роботи (вихідні)</label
                >
                <InputText
                    v-model="serviceData.weekend_end_work"
                    id="service_weekend_end"
                    type="time"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_location">Локація</label>
                <InputText
                    v-model="serviceData.location"
                    id="service_location"
                    class="w-full!"
                />
            </FloatLabel>

            <FloatLabel variant="in" class="w-full!">
                <label for="service_phone">Телефон</label>
                <InputText
                    v-model="serviceData.phone"
                    id="service_phone"
                    class="w-full!"
                />
            </FloatLabel>

            <Button @click="createService" label="Створити" />
        </form>
    </div>
</template>
