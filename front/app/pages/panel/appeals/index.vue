<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const {
    data: appeal,
    error,
    status,
} = await useFetch("http://localhost/admin/appeal", {
    headers: {
        Authorization: `Bearer ${token.value}`,
    },
});
const deleteItem = async (id) => {
    try {
        const { data, error, status } = await useFetch(
            `http://localhost/admin/appeal/${id}`,
            {
                method: "DELETE",
                headers: {
                    Authorization: `Bearer ${token.value}`, // переконайся, що token.value є
                },
            }
        );

        if (error.value) {
            console.error("Помилка при видаленні:", error.value);
            return;
        }
        appeal.value = appeal.value.filter((item) => item.id !== id);
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>
<template>
    <div class="main-container my-[60px] flex flex-col gap-5">
        <h2 class="font-bold text-2xl">Звернення</h2>
        <NuxtLink to="/panel/appeals/create">
            <Button label=" Create"
        /></NuxtLink>
        <DataTable
            :value="appeal"
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
            <Column field="content" header="Повідомлення"></Column>
            <Column field="title" header="Заголовок"></Column>
            <Column field="created_at" header="Створено"></Column>
            <Column field="updated_at" header="Відредаговано"></Column>
            <Column header="Дії">
                <template #body="{ data }">
                    <div class="flex items-center gap-2">
                        <Button
                            @click="deleteItem(data.id)"
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
