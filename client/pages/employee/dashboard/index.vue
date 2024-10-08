<template>
    <NuxtLayout name="default">
        <Title>Dashboard - {{ runtimeConfig.public.appName }}</Title>
        <h1>Default Dashboard</h1>
    </NuxtLayout>
</template>

<script setup lang="ts">
const runtimeConfig = useRuntimeConfig();
</script>