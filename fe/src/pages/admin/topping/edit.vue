<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a-card title="Update topping" style="width: 100%">
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
            :model="topping"
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
              <a-input v-model:value="topping.name" />
            </a-form-item>
            <a-form-item
              label="Giá"
              name="price"
              :rules="[{ required: true, message: 'Please input your price!' }]"
            >
              <a-input v-model:value="topping.price" />
            </a-form-item>
            <a-form-item
              label="Giảm giá (%)"
              name="discount"
              :rules="[
                { required: true, message: 'Please input your discount!' },
              ]"
            >
              <a-input v-model:value="topping.discount" />
            </a-form-item>
            <a-form-item
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <select
                class="form-select form-select-sm"
                v-model="topping.status"
              >
                <option
                  style="border-radius: 5px"
                  v-for="(is, index) in options"
                  :key="index"
                  :value="is.value"
                >
                  {{ is.label }}
                </option>
              </select>
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 4, span: 16 }">
              <a-button
                :class="{ sendRequest: isPending }"
                type="primary"
                html-type="submit"
                >{{ isPending ? "Loading..." : "Update" }}</a-button
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
import { defineComponent, onMounted, ref } from "vue";
import { notification, message } from "ant-design-vue";
import useTopping from "@/composables/admin/useTopping";
import { useRouter, useRoute } from "vue-router";
export default defineComponent({
  name: "update-topping",
  setup() {
    const options = [
      {
        label: "Hoạt động",
        value: "1",
      },
      {
        label: "Tạm dừng hoạt động",
        value: "0",
      },
    ];
    const router = useRoute();
    const routes = useRouter();
    const id = router.params.id;
    const formRef = ref();
    const { updateTopping, topping, getTopping, isPending, errors } =
      useTopping();
    const onFinish = async (values) => {
      console.log("Success:", values);
      await updateTopping(id);
      if (!errors.value) {
        openNotification();
        resetForm();
        setTimeout(() => {
          routes.push({ name: "admin-topping" });
        }, 0.3);
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
        description: "Đã cập nhật dữ liệu cho   topping thành công",
      });
    };
    const resetForm = () => {
      formRef.value.resetFields();
    };
    onMounted(() => {
      getTopping(id);
    });
    return {
      options,
      onFinish,
      onFinishFailed,
      openNotification,
      formRef,
      topping,
      resetForm,
      isPending,
      errors,
    };
  },
});
</script>

<style scoped>
.sendRequest {
  opacity: 0.5;
}
</style>
