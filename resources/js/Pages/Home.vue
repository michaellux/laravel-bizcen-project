<template>
  <div>
    <AppHead title="Заявка на возврат" />
    <h1 class="text-4xl font-bold">Заявка на возврат товара</h1>
  </div>
  <form
    @submit.prevent="submit"
    class="flex flex-col space-y-3 m-auto mt-10 gap-3"
  >
    <div class="form-block">
      <label for="name">Имя</label>
      <InputText
        required
        id="name"
        name="name"
        v-model="form.name"
        class="w-full p-3 !border-s-green-400 mt-1"
      />
    </div>
    <div class="form-block">
      <label for="surname">Фамилия</label>
      <InputText
        required
        id="surname"
        name="surname"
        v-model="form.surname"
        class="w-full p-3 mt-1"
      />
    </div>
    <div class="form-block">
      <label for="phone">Телефонный номер</label>
      <InputMask
        required
        class="w-full p-3 mt-1"
        id="phone"
        name="phone"
        v-model="form.phone"
        mask="+7 (999) 999-9999"
      />
    </div>
    <div class="form-block">
      <label for="applicationText">Текст заявки</label>
      <Textarea
        required
        id="text"
        name="text"
        v-model="form.text"
        class="w-full h-24 p-3 mt-1"
      />
    </div>

    <Button
      type="submit"
      label="Отправить заявку"
      class="p-3 border-green-500"
      :disabled="form.processing"
    />
  </form>
</template>

<script setup>
import { ref } from "vue";
import AppHead from "../Shared/AppHead.vue";
import { useForm } from "@inertiajs/vue3";
let form = useForm({
  name: "",
  surname: "",
  phone: "",
  text: "",
});

let submit = () => {
  form.post("/send-query", form);
};
</script>

<style scoped>
.p-inputtext {
  border: 1px solid #d1d5db;
  border-radius: 6px;
}
.p-button {
  box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #71f3c8, 0 1px 2px 0 black;
}
</style>
