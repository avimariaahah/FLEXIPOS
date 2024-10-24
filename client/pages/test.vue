<template>
    <div>
        <h1>This is a test page</h1>
        <button @click="triggerError">Trigger Error</button>
    </div>
</template>

<script setup>
function triggerError() {
    throw new Error('This is a test error!');
}
</script>