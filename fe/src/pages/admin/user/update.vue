<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
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
        <a-card title="Update tài khoản" style="width: 100%">
          <a-form
            :model="user"
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
              ]"
            >
              <a-input v-model:value="user.name" />
            </a-form-item>
            <a-form-item label="Email" name="email">
              <a-input disabled v-model:value="user.email" />
            </a-form-item>
            <a-form-item
              label="Role"
              name="role_id"
              :rules="[{ required: true, message: 'Please input your role!' }]"
            >
              <a-radio-group name="role_id" v-model:value="user.role_id">
                <a-radio
                  v-for="(role, index) in roles"
                  :key="index"
                  :value="role.id"
                  >{{ role.name.toUpperCase() }}</a-radio
                >
              </a-radio-group>
            </a-form-item>
            <a-form-item
              name="isActive"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <select
                class="form-select form-select-sm"
                v-model="user.isActive"
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
            </a-form-item>
          </a-form>
        </a-card>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref } from "vue";
import { notification } from "ant-design-vue";
import useUser from "@/composables/admin/useUser";
import useRoles from "@/composables/admin/useRole";
import { useRoute, useRouter } from "vue-router";
export default defineComponent({
  name: "update-user",
  setup() {
    //get option
    const options = ref([
      {
        value: "0",
        label: "Tạm dừng hoạt động",
      },
      {
        value: "1",
        label: "Đang hoạt động",
      },
    ]);
    const router = useRoute();
    const routes = useRouter();
    //lay ra id tren parameter router
    const id = router.params.id;
    const { getUser, user, updateUser, errors, isPending } = useUser();
    //check validater thanh cong
    const onFinish = async (values) => {
      console.log("Success:", values);
      await updateUser(id);
      if (!errors.value) {
        openNotification();
        setTimeout(() => {
          routes.push({ name: "admin-user" });
        }, 0.3);
      } else {
        return;
      }
    };
    const { roles, getRoles } = useRoles();
    //validater that bat
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
    };
    //show thong bao
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Update tài khoản thành công",
      });
    };
    //lay ra id va role
    onMounted(() => {
      getUser(id);
      getRoles();
    });
    return {
      options,
      onFinish,
      onFinishFailed,
      openNotification,
      user,
      roles,
      errors,
      isPending,
    };
  },
});
</script>

<style scoped></style>
