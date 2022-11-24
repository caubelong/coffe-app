<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <a-card title="Thêm sản phẩm" style="width: 100%">
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
            enctype="multipart/form-data"
            ref="formRef"
            :model="product"
            name="basic"
            :label-col="{ span: 4 }"
            :wrapper-col="{ span: 10 }"
            @finish="onFinish"
            @finishFailed="onFinishFailed"
          >
            <a-form-item
              label="Tên sản phẩm"
              name="name"
              :rules="[
                { required: true, message: 'Please input your product name!' },
              ]"
            >
              <a-input v-model:value="product.name" />
            </a-form-item>
            <a-form-item
              name="cate_id"
              label="Danh mục"
              :rules="[{ required: true, message: 'Missing area category id' }]"
            >
              <a-select v-model:value="product.cate_id">
                <a-select-option
                  v-for="(category, index) in categories"
                  :key="index"
                  :value="category.id"
                  >{{ category.name }}</a-select-option
                >
              </a-select>
            </a-form-item>
            <a-form-item
              label="Giá"
              name="price"
              :rules="[{ required: true, message: 'Please input your price!' }]"
            >
              <a-input v-model:value="product.price" />
            </a-form-item>
            <a-form-item label="Giảm giá (%)" name="discount">
              <a-input v-model:value="product.discount" />
            </a-form-item>
            <a-form-item
              label="Mô tả sản phẩm"
              name="desc"
              :rules="[{ required: true, message: 'Please input your desc!' }]"
            >
              <a-textarea
                v-model:value="product.desc"
                placeholder="Nhập mô tả cho sản phẩm ...."
                :rows="4"
              />
            </a-form-item>
            <a-form-item label="Ảnh mô tả sản phẩm">
              <a-image
                :width="100"
                :src="product.thumbnail"
                :alt="product.name"
              />
            </a-form-item>
            <a-form-item
              name="thumbnail"
              label="Upload ảnh mô tả mới"
              v-model="product.thumbnail"
            >
              <!--su dung before upload de chan auto tai len-->
              <a-upload
                @change="onChange"
                :before-upload="
                  () => {
                    return false;
                  }
                "
                name="thumbnail"
                list-type="picture"
              >
                <a-button>
                  <upload-outlined></upload-outlined>
                  Click to Upload
                </a-button>
              </a-upload>
            </a-form-item>
            <a-form-item
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area' }]"
            >
              <select
                class="form-select form-select-sm"
                v-model="product.status"
              >
                <option
                  style="border-radius: 5px"
                  v-for="(status, index) in active"
                  :key="index"
                  :value="status.value"
                >
                  {{ status.label }}
                </option>
              </select>
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 4, span: 16 }">
              <a-button
                :class="{ isPending: isPending }"
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
import useProduct from "@/composables/admin/useProduct";
import useCategory from "@/composables/admin/useCategory";
import { defineComponent, ref, onMounted } from "vue";
import { notification } from "ant-design-vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { useRouter, useRoute } from "vue-router";
export default defineComponent({
  name: "edit-comp",
  components: {
    UploadOutlined,
  },
  setup() {
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
    const router = useRoute();
    const id = router.params.id;
    const routes = useRouter();
    const formRef = ref();
    const { getProduct, product, updateProduct, errors, isPending } =
      useProduct();
    //lay ra category de dien form
    const { getCategories, categories } = useCategory();
    onMounted(() => {
      getCategories();
      getProduct(id);
    });
    const onChange = (e) => {
      if (e.file) {
        product.value.thumbnail = e.file;
      } else {
        product.value.thumbnail = "";
      }
      console.log(e);
    };
    const onFinish = async (values) => {
      await updateProduct(id);
      console.log("Success:", values);
      if (!errors.value) {
        openNotification();
        resetForm();
        setTimeout(() => {
          routes.push({ name: "admin-product" });
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
        description: "Cập nhật thông tin cho sản phẩm thành công",
      });
    };
    const resetForm = () => {
      formRef.value.resetFields();
    };
    return {
      active,
      onFinish,
      onFinishFailed,
      openNotification,
      formRef,
      resetForm,
      categories,
      onChange,
      product,
      errors,
      isPending,
    };
  },
});
</script>

<style scoped>
.isPending {
  opacity: 0.5;
}
</style>
