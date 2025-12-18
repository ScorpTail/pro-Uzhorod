<script setup>
const route = useRoute();
const { setToken, token } = useAuth();
const navigationLinks = ref([
    { name: "Головна", link: "/" },
    { name: "Пам'ятки", link: "/attractions" },
    { name: "Послуги", link: "/services" },
    { name: "Новини", link: "/news" },
    { name: "Про нас", link: "/about" },
    { name: "Контакти", link: "/contacts" },
]);
const isRouteActive = (path) => route.fullPath === path;

const scrolledPast = ref(false);

const handleScroll = () => {
    scrolledPast.value = window.scrollY > 20;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
const isModalOpen = ref(false);

const authData = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const formState = ref("signup");

const displayFormLabel = computed(() => {
    if (formState.value === "login") {
        return "Увійти";
    } else {
        return "Зареєструватись";
    }
});

const formToggleButton = computed(() => {
    if (formState.value === "login") {
        return "Зареєструватись";
    } else {
        return "Увійти";
    }
});

const isLoggedIn = computed(() => !!token.value);

const toggleFormState = () => {
    if (formState.value === "login") {
        formState.value = "signup";
    } else {
        formState.value = "login";
    }
};

const loginLoading = ref(false);
const loginError = ref("");

const login = async () => {
    loginError.value = "";
    loginLoading.value = true;

    try {
        const { data, error } = await useFetch(
            "http://localhost/api/v1/auth/login",
            {
                method: "POST",
                body: {
                    name: authData.value.name,
                    email: authData.value.email,
                    password: authData.value.password,
                },
            }
        );

        if (error.value) {
            throw error.value;
        }

        setToken(data.value.token);

        isModalOpen.value = false;
    } catch (err) {
        loginError.value =
            err?.data?.message || "Помилка входу. Перевірте дані.";
    } finally {
        loginLoading.value = false;
    }
};
const signup = async () => {
    loginError.value = "";
    loginLoading.value = true;

    try {
        const { data, error } = await useFetch(
            "http://localhost/api/v1/auth/register",
            {
                method: "POST",
                body: {
                    name: authData.value.name,
                    email: authData.value.email,
                    password: authData.value.password,
                    password_confirmation: authData.value.password_confirmation,
                },
            }
        );

        if (error.value) {
            throw error.value;
        }

        setToken(data.value.token);
        isModalOpen.value = false;
    } catch (err) {
        loginError.value =
            err?.data?.message || "Помилка входу. Перевірте дані.";
    } finally {
        loginLoading.value = false;
    }
};

const logout = async () => {
    try {
        await useFetch("http://localhost/api/v1/auth/logout", {
            method: "POST",
            headers: {
                Authorization: `Bearer ${token.value}`,
            },
        });
        setToken(null);
        isModalOpen.value = false;
    } catch (err) {
        console.error("Logout failed:", err);
    }
};
</script>
<template>
    <header
        class="flex items-center w-full justify-between h-16 fixed z-9999 top-0"
        :class="[
            { 'top-1 bg-transparent': scrolledPast },
            scrolledPast ? 'bg-transparent' : 'bg-white',
        ]"
    >
        <div
            class="main-container flex items-center justify-between transition-all duration-300 border border-transparent"
            :class="{
                'max-w-[750px] p-2 bg-white border-gray-200 rounded-3xl shadow-xl':
                    scrolledPast,
            }"
        >
            <NuxtLink to="/" class="flex items-center gap-2">
                <div class="bg-blue p-2 rounded-xl">
                    <span class="text-white leading-none uppercase">уж</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="font-medium text-xl leading-none"
                        >Ужгород</span
                    >
                    <span class="font-normal text-[14px] leading-none"
                        >Міський портал</span
                    >
                </div>
            </NuxtLink>

            <button class="flex md:hidden items-center justify-center h-4 w-4">
                <i class="pi pi-bars text-2xl"></i>
            </button>
            <nav class="hidden md:flex items-center gap-3">
                <ul class="flex items-center gap-4">
                    <li v-for="link in navigationLinks">
                        <NuxtLink
                            :to="link.link"
                            :class="[
                                'hover:text-blue transition-colors duration-300 text-sm',
                                { 'text-blue': isRouteActive(link.link) },
                            ]"
                            >{{ link.name }}</NuxtLink
                        >
                    </li>
                </ul>
                <button
                    @click="logout"
                    v-if="isLoggedIn"
                    class="bg-red-500 text-white rounded-xl p-1 px-3 text-sm cursor-pointer"
                >
                    Вийти
                </button>
                <button
                    v-else
                    @click="isModalOpen = true"
                    class="bg-blue text-white rounded-xl p-1 px-3 text-sm cursor-pointer"
                >
                    Увійти
                </button>
            </nav>
        </div>
    </header>
    <Teleport to="#teleports">
        <div
            v-if="isModalOpen"
            @mousedown="isModalOpen = false"
            class="fixed top-0 left-0 right-0 bottom-0 bg-black/50 z-99999 flex items-center justify-center"
        >
            <div
                @mousedown.stop
                class="bg-white rounded-xl p-6 w-full max-w-[500px]"
            >
                <form @submit.prevent class="w-full flex flex-col gap-2">
                    <span class="text-2xl font-medium text-center">{{
                        displayFormLabel
                    }}</span>
                    <FloatLabel variant="in" class="w-full!">
                        <label for="name">Імя</label>
                        <InputText
                            v-model="authData.name"
                            id="name"
                            class="w-full"
                        />
                    </FloatLabel>
                    <FloatLabel variant="in" class="w-full!">
                        <label for="email">Email</label>
                        <InputText
                            v-model="authData.email"
                            id="email"
                            class="w-full"
                        />
                    </FloatLabel>
                    <FloatLabel variant="in" class="w-full!">
                        <label for="in_password">Пароль</label>
                        <InputText
                            v-model="authData.password"
                            type="password"
                            inputId="in_password"
                            class="w-full!"
                        />
                    </FloatLabel>
                    <FloatLabel
                        v-if="formState === 'signup'"
                        variant="in"
                        class="w-full!"
                    >
                        <label for="in_password">Повторіть Пароль</label>
                        <InputText
                            v-model="authData.password_confirmation"
                            type="password"
                            inputId="in_password"
                            class="w-full!"
                        />
                    </FloatLabel>
                    <Button
                        @click="formState === 'login' ? login() : signup()"
                        severity="contrast"
                        :label="displayFormLabel"
                        class="w-full!"
                    />
                    <Button
                        severity="secondary"
                        @click="toggleFormState"
                        :label="formToggleButton"
                    />
                </form>
            </div>
        </div>
    </Teleport>
</template>
