<script setup>
import { onMounted, ref } from "vue";

definePageMeta({
    layout: "panel-layout",
});

const { token } = useAuth();
const route = useRoute();
const serviceId = route.params.id;

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

// Завантаження існуючого сервісу
const loadService = async () => {
    try {
        const { data, error } = await useFetch(
            `http://localhost/admin/service/edit/${serviceId}`,
            {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            }
        );

        if (error.value) {
            console.error("Помилка при завантаженні сервісу:", error.value);
            return;
        }

        if (data.value) {
            const service = data.value.service || data.value;
            Object.keys(serviceData.value).forEach((key) => {
                if (service[key] !== undefined) {
                    serviceData.value[key] = service[key];
                }
            });
        }
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};

onMounted(() => {
    loadService();
});

// Оновлення сервісу
const updateService = async () => {
    try {
        const payload = {};
        Object.keys(serviceData.value).forEach((key) => {
            const val = serviceData.value[key];
            if (val !== "" && val !== null && val !== undefined) {
                // Перетворюємо working_days на рядок
                payload[key] = key === "working_days" ? String(val) : val;
            }
        });

        const { data, error } = await useFetch(
            `http://localhost/admin/service/${serviceId}`,
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
            console.error("Помилка при оновленні сервісу:", error.value);
            return;
        }

        alert("Сервіс оновлено!");
    } catch (err) {
        console.error("Помилка при оновленні сервісу:", err);
    }
};
</script>

<template>
    <div class="main-container my-[120px]">
        <form @submit.prevent class="flex flex-col gap-3">
            <h2 class="text-2xl font-medium">Редагувати Сервіс</h2>

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
                    rows="6"
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
                    type="text"
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

            <Button @click="updateService" severity="warn" label="Оновити" />
        </form>
    </div>
</template>
