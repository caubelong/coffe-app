<template>
  <a-popconfirm
    title="Bạn có chắc muốn xóa topping này không ?"
    cancel-text="No"
    ok-text="Yes"
    @confirm="removeUser"
    @cancel="cancel"
  >
    <DeleteOutlined></DeleteOutlined>
  </a-popconfirm>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import useUser from "@/composables/admin/useUser";
export default {
  name: "delete-comp",
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  emits: ["deleteSuccess"],
  components: {
    DeleteOutlined,
  },
  setup(props, context) {
    const { destroyUser } = useUser();
    const removeUser = async () => {
      await destroyUser(props.id);
      context.emit("deleteSuccess");
    };
    const cancel = () => {
      return;
    };
    return {
      removeUser,
      cancel,
    };
  },
};
</script>

<style scoped></style>
