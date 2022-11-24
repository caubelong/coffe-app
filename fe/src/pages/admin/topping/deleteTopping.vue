<template>
  <a-popconfirm
    title="Bạn có chắc muốn xóa topping này không ?"
    cancel-text="No"
    ok-text="Yes"
    @confirm="removeToppings"
    @cancel="cancel"
  >
    <DeleteOutlined></DeleteOutlined>
  </a-popconfirm>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import useTopping from "@/composables/admin/useTopping";
import { notification } from "ant-design-vue";
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
    const { removeTopping } = useTopping();
    const removeToppings = async () => {
      await removeTopping(props.id);
      context.emit("deleteSuccess");
      openNotification();
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Đã xóa topping",
      });
    };
    const cancel = () => {
      return;
    };
    return {
      removeToppings,
      cancel,
    };
  },
};
</script>

<style scoped></style>
