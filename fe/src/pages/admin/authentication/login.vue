<template>
  <div class="mb-3 w-75">
    <a-alert :closable="true" type="error" show-icon />
  </div>
  <a-form
    style="margin: 20px"
    :model="formState"
    name="basic"
    :label-col="{ span: 6 }"
    :wrapper-col="{ span: 11 }"
    autocomplete="off"
    @finish="onFinish"
    @finishFailed="onFinishFailed"
  >
    <a-form-item
      label="Email"
      name="email"
      :rules="[
        { required: true, message: 'Please input your email!' },
        {
          type: 'email',
          message: 'Please input incorrect email format',
        },
      ]"
    >
      <a-input v-model:value="formState.email" />
    </a-form-item>

    <a-form-item
      label="Password"
      name="password"
      :rules="[{ required: true, message: 'Please input your password!' }]"
    >
      <a-input-password v-model:value="formState.password" />
    </a-form-item>

    <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
      <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
    </a-form-item>

    <a-form-item :wrapper-col="{ offset: 16 }">
      <a-button type="primary" html-type="submit">Login</a-button>
    </a-form-item>
  </a-form>
</template>

<script>
// import useAuth from "@/composables/admin/useAuth";
// import { useRouter } from "vue-router";
import { defineComponent, reactive } from "vue";
export default defineComponent({
  name: "login-comp",
  setup() {
    const formState = reactive({
      email: "",
      password: "",
    });
    // const { login, errors, isPending } = useAuth();
    // const route = useRouter();
    const onFinish = async (values) => {
      console.log("Success:", values);
      // await login({ ...formState });
      // await route.push("admin/product");
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    return {
      formState,
      onFinish,
      onFinishFailed,
      // errors,
      // isPending,
    };
  },
});
</script>

<style scoped></style>
