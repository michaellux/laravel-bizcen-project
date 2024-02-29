<template>
  <div>
    <AppHead title="Заявка на возврат" />
    <h1 class="text-4xl font-bold">Заявка на возврат товара</h1>
  </div>
  <form class="flex flex-col space-y-10 m-auto mt-10">
    <FloatLabel>
      <InputText v-model="name" class="w-full p-3 !border-s-green-400" />
      <label for="name">Имя</label>
    </FloatLabel>
    <FloatLabel>
      <InputText v-model="surname" class="w-full p-3" />
      <label for="surname">Фамилия</label>
    </FloatLabel>
    <FloatLabel>
      <InputMask
        class="w-full p-3"
        id="phone"
        v-model="phone"
        mask="+7 (999) 999-9999"
      />
      <label for="phone">Телефонный номер</label>
    </FloatLabel>
    <FloatLabel>
      <Textarea v-model="applicationText" class="w-full h-24 p-3" />
      <label for="applicationText">Текст заявки</label>
    </FloatLabel>
    <p-button
      label="Отправить заявку"
      class="self-center"
      @click="submitApplication"
    />
  </form>
</template>

<script setup>
import AppHead from "../Shared/AppHead.vue";
</script>

<style scoped>
.p-float-label {
  border: 1px solid #d1d5db;
  border-radius: 6px;
}
</style>
