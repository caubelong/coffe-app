<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a-card title="Thêm tài khoản" style="width: 100%">
          <div class="mb-3 w-75" v-for="(error, index) in errors" :key="index">
            <a-alert
              :closable="true"
              v-for="err in error"
              :key="err"
              :message="err"
              type="error"
              show-icon
            />
          </div>
          <a-form
            ref="formRef"
            :model="formState"
            name="basic"
            :label-col="{ span: 4 }"
            :wrapper-col="{ span: 10 }"
            @finish="onFinish"
            @finishFailed="onFinishFailed"
          >
            <a-form-item
              label="Username"
              name="name"
              :rules="[
                { required: true, message: 'Please input your username!' },
                { min: 3, message: 'User name must be minimum 3 characters.' },
                { max: 20, message: 'User name no longer than 20 characters.' },
              ]"
            >
              <a-input v-model:value="formState.name" />
            </a-form-item>
            <a-form-item
              label="Password"
              name="password"
              :rules="[
                { required: true, message: 'Please input your password!' },
                { min: 5, message: 'Password must be minimum 05 characters.' },
                { max: 20, message: 'Password no longer than 20 characters.' },
              ]"
            >
              <a-input-password v-model:value="formState.password" />
            </a-form-item>
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
              label="Vai trò"
              name="role_id"
              :rules="[{ required: true, message: 'Please input role' }]"
            >
              <a-radio-group v-model:value="formState.role_id">
                <a-radio
                  v-for="(role, id) in roles"
                  :key="id"
                  :value="role.id"
                  >{{ role.name }}</a-radio
                >
              </a-radio-group>
            </a-form-item>
            <a-form-item
              name="isActive"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <a-select v-model:value="formState.isActive" :options="active" />
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 4, span: 16 }">
              <a-button
                :class="{ sendRequest: isPending }"
                type="primary"
                html-type="submit"
                >{{ isPending ? "Loading..." : "Thêm" }}</a-button
              >
              <a-button style="margin-left: 10px" @click="resetForm"
                >Reset</a-button
              >
            </a-form-item>
          </a-form>
        </a-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, reactive, ref, onMounted } from "vue";
import useRoles from "@/composables/admin/useRole";
import { notification } from "ant-design-vue";
import useUser from "@/composables/admin/useUser";
export default defineComponent({
  name: "create-user",
  setup() {
    const { roles, getRoles } = useRoles();
    onMounted(getRoles);
    const formState = reactive({
      name: "",
      password: "",
      isActive: "",
      email: "",
      role_id: "",
    });
    const active = [
      {
        label: "Hoạt động",
        value: "1",
      },
      {
        label: "Tạm dừng hoạt động",
        value: "0",
      },
    ];
    const formRef = ref();
    const { storeUser, isPending, errors } = useUser();
    const onFinish = async (values) => {
      console.log("Success:", values);
      await storeUser({ ...formState });
      if (!errors.value) {
        openNotification();
        resetForm();
      } else {
        return;
      }
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Tạo mới tài khoản thành công",
      });
    };
    const resetForm = () => {
      formRef.value.resetFields();
    };
    return {
      formState,
      active,
      onFinish,
      onFinishFailed,
      openNotification,
      formRef,
      roles,
      resetForm,
      errors,
      isPending,
    };
  },
});
</script>

<style scoped></style>
