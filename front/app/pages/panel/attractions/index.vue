<script setup>
definePageMeta({
    layout: "panel-layout",
});

const { data, error, status } = await useFetch(
    "http://localhost/api/v1/attraction"
);
console.log(data);
</script>
<template>
    <div class="main-container">
        <DataTable
            :value="data.attractions"
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
            <Column field="description" header="Опис"></Column>
            <Column field="location" header="Адреса"></Column>
            <Column field="rating" header="Рейтинг"></Column>
            <Column header="Час роботи" class="">
                <template #body="{ data }">
                    <ClientOnly>
                        <div class="whitespace-nowrap">
                            <NuxtTime
                                :datetime="`1970-01-01T${data.start_time}`"
                                hour="2-digit"
                                minute="2-digit"
                            />
                            –
                            <NuxtTime
                                :datetime="`1970-01-01T${data.end_time}`"
                                hour="2-digit"
                                minute="2-digit"
                            />
                        </div>
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
