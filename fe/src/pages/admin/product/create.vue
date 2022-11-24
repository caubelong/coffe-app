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
            :model="formState"
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
              <a-input v-model:value="formState.name" />
            </a-form-item>
            <a-form-item
              name="cate_id"
              label="Danh mục"
              :rules="[{ required: true, message: 'Missing area category id' }]"
            >
              <a-select v-model:value="formState.cate_id">
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
              <a-input v-model:value="formState.price" />
            </a-form-item>
            <a-form-item label="Giảm giá (%)" name="discount">
              <a-input v-model:value="formState.discount" />
            </a-form-item>
            <a-form-item
              label="Mô tả sản phẩm"
              name="desc"
              :rules="[{ required: true, message: 'Please input your desc!' }]"
            >
              <a-textarea
                v-model:value="formState.desc"
                placeholder="Nhập mô tả cho sản phẩm ...."
                :rows="4"
              />
            </a-form-item>
            <a-form-item
              name="thumbnail"
              label="Ảnh mô tả"
              v-model="formState.thumbnail"
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
              v-model="formState.status"
              name="status"
              label="Trạng thái"
              :rules="[{ required: true, message: 'Missing area status' }]"
            >
              <a-select v-model:value="formState.status" :options="active" />
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 4, span: 16 }">
              <a-button
                :class="{ isPending: isPending }"
                type="primary"
                html-type="submit"
                >{{ isPending ? "Loading... " : "Thêm" }}</a-button
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
import { defineComponent, reactive, ref, onMounted } from "vue";
import { notification } from "ant-design-vue";
import { UploadOutlined } from "@ant-design/icons-vue";
export default defineComponent({
  name: "create-product",
  components: {
    UploadOutlined,
  },
  setup() {
    const formState = reactive({
      name: "",
      cate_id: "",
      status: "",
      price: "",
      desc: "",
      thumbnail: "",
      discount: 0,
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
    const { storeProduct, errors, isPending } = useProduct();
    //lay ra category de dien form
    const { getCategories, categories } = useCategory();
    onMounted(() => {
      getCategories();
    });
    const onChange = (e) => {
      formState.thumbnail = e.file;
    };
    const onFinish = async (values) => {
      console.log("Success:", values);
      storeProduct({ ...formState });
      if (!errors.value) {
        openNotification();
        resetForm();
      } else {
        return;
      }
    };
    const onFinishFailed = (errorInfo) => {
      console.log("Failed:", errorInfo);
      console.log(formState.thumbnail);
    };
    const openNotification = () => {
      notification.open({
        message: "Notification",
        description: "Tạo mới sản phẩm thành công",
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
      categories,
      onChange,
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
