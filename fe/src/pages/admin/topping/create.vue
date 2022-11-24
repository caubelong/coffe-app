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
              label="Tên topping"
              name="name"
              :rules="[
                { required: true, message: 'Please input your topping name!' },
                { min: 3, message: 'Role name must be minimum 3 characters.' },
                { max: 20, message: 'Role name no longer than 20 characters.' },
              ]"
            >
              <a-input v-model:value="formState.name" />
            </a-form-item>
            <a-form-item
              label="Giá"
              name="price"
              :rules="[{ required: true, message: 'Please input your price!' }]"
            >
              <a-input v-model:value="formState.price" />
            </a-form-item>
            <a-form-item
              label="Giảm giá (%)"
              name="discount"
              :rules="[
                { required: true, message: 'Please input your discount!' },
              ]"
            >
              <a-input v-model:value="formState.discount" />
            </a-form-item>
            <a-form-item
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <a-select v-model:value="formState.status" :options="active" />
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
import { defineComponent, reactive, ref } from "vue";
import { notification } from "ant-design-vue";
import useTopping from "@/composables/admin/useTopping";
export default defineComponent({
  name: "create-user",
  setup() {
    const formState = reactive({
      name: "",
      price: "",
      status: "",
      discount: "0",
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
    const { storeTopping, isPending, errors } = useTopping();
    const onFinish = async (values) => {
      console.log("Success:", values);
      await storeTopping({ ...formState });
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
        description: "Tạo mới topping thành công",
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
      resetForm,
      errors,
      isPending,
    };
  },
});
</script>

<style scoped>
.sendRequest {
  opacity: 0.5;
}
</style>
