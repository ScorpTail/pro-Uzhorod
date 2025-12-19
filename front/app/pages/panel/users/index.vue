<script setup>
const { token } = useAuth();
definePageMeta({
    layout: "panel-layout",
});

const {
    data: user,
    error,
    status,
} = await useFetch("http://localhost/admin/user", {
    headers: {
        Authorization: `Bearer ${token.value}`,
        "Content-Type": "application/json",
        Accept: "application/json",
    },
});

const deleteItem = async (id) => {
    try {
        const { data, error, status } = await useFetch(
            `http://localhost/admin/user/${id}`,
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
        user.value = user.value.filter((item) => item.id !== id);
    } catch (err) {
        console.error("Помилка запиту:", err);
    }
};
</script>
<template>
    <div class="main-container flex flex-col gap-5 my-[60px]">
        <h2 class="font-bold text-2xl">Користувачі</h2>
        <NuxtLink to="/panel/users/create"> <Button label="Create" /></NuxtLink>
        <DataTable
            :value="user"
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
            <Column field="email" header="Email"></Column>

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
                <template #body="{ data }">
                    <div class="flex items-center gap-2">
                        <NuxtLink :to="`/panel/users/edit/${data.id}`">
                            <Button
                                rounded
                                variant="text"
                                severity="warn"
                                icon="pi pi-pencil"
                            />
                        </NuxtLink>
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
