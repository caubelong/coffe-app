<template>
  <a-popconfirm
    title="Bạn có chắc muốn xóa sản phẩm này không ?"
    cancel-text="No"
    ok-text="Yes"
    @confirm="confirm"
    @cancel="cancel"
  >
    <DeleteOutlined></DeleteOutlined>
  </a-popconfirm>
</template>

<script>
import { DeleteOutlined } from "@ant-design/icons-vue";
import { defineComponent } from "vue";
import { message } from "ant-design-vue";
import useProduct from "@/composables/admin/useProduct";
export default defineComponent({
  components: {
    DeleteOutlined,
  },
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  emits: ["deleteSuccess"],
  setup(props, context) {
    const { removeProduct } = useProduct();
    const confirm = async () => {
      await removeProduct(props.id);
      message.success("Xóa sản phẩm thành công");
      context.emit("deleteSuccess");
    };

    const cancel = () => {
      return;
    };

    return {
      confirm,
      cancel,
    };
  },
});
</script>
<style scoped></style>
