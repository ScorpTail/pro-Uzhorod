<script setup>
definePageMeta({
    layout: "panel-layout",
});

const { data, error, status } = await useFetch(
    "http://localhost/api/v1/service"
);
console.log(data);
</script>
<template>
    <div class="main-container">
        <DataTable
            :value="data.services"
            :loading="status === 'pending'"
            paginator
            :rows="6"
            stripedRows
        >
            <Column field="id" sortable header="ID">
                <template #body="{ data }">
                    <NuxtLink
                        class="text-blue-600"
                        :to="`/panel/news/${data.id}`"
                        >{{ data.id }}</NuxtLink
                    >
                </template>
            </Column>
            <Column field="name" header="Назва"></Column>
            <Column field="short_description" header="Стислий Опис"></Column>
            <Column field="description" header="Опис"></Column>
            <Column field="phone" header="Номер телефону"></Column>
            <Column header="Створено">
                <template #body="{ data }">
                    <NuxtTime
                        :datetime="data.created_at"
                        day="2-digit"
                        month="2-digit"
                        year="numeric"
                    />
                </template>
            </Column>
            <Column header="Оновлено">
                <template #body="{ data }">
                    <ClientOnly>
                        <NuxtTime
                            :datetime="data.updated_at"
                            day="2-digit"
                            month="2-digit"
                            year="numeric"
                        />
                    </ClientOnly>
                </template>
            </Column>
            <Column header="Дії">
                <template #body>
                    <div class="flex items-center gap-2">
                        <Button
                            rounded
                            variant="text"
                            severity="warn"
                            icon="pi pi-pencil"
                        />
                        <Button
                            rounded
                            variant="text"
                            severity="danger"
                            icon="pi pi-trash"
                        />
                    </div>
                </template>
            </Column>
        </DataTable>
    </div>
</template>
