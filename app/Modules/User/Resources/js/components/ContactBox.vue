<template>
  <div class="contact-box">
    <div class="c-content">
      <div class="email">
        <form action="" method="get" class="contact-form">
          <h3>Bạn đang tìm kiếm một đối tác Việt Nam?</h3>
          <h3>Hãy liên hệ với chúng tôi</h3>
          <div class="content">
            <input
              type="text"
              name=""
              required="required"
              placeholder="Tên sản phẩm hoặc từ khóa"
            />
          </div>
          <div class="content">
            <textarea
              name="noidung"
              rows="4"
              required="required"
              placeholder="Nội dung"
            ></textarea>
          </div>
          <div class="content">
            <input type="submit" name="" id="" value="Gửi" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "contact-box",
};
</script>

<style scoped lang="scss">
.contact-box {
  width: 100%;
  margin-bottom: 60px;
  background: #fafafa;
  box-sizing: border-box;

  .c-content {
    background-image: url("/images/footer-img.png");
    background-color: #dfded6;
    background-repeat: no-repeat;
    display: flex;
    height: 615px;
    overflow: hidden;

    .email {
      margin: 58px 0 40px 635px;
      width: 50%;
      height: 80%;
      padding: 40px;
      background: #fff;

      h3 {
        font-size: 27px;
        font-weight: bold;
      }
      .content {
        position: relative;
        width: 100%;
        margin-top: 35px;

        input,
        textarea {
          width: 100%;
          padding: 10px;
          border: 1px solid #e0e0e0;
          resize: none;
          outline: none;
          font-size: 16px;
          &::placeholder {
            color: #b9b9b9;
          }
        }
        input[type="submit"] {
          width: 210px;
          background: #24a67f;
          color: #fff;
          border: none;
          cursor: pointer;
          height: 50px;
          font-size: 16px;
        }
      }
    }
  }
}

@media screen and (max-width: 480px) {
  .contact-box {
    margin-bottom: 15px;

    .c-content {
      width: auto;
      height: 300px;
      box-sizing: border-box;
      background-position: center center;
      display: flex;

      .email {
        padding: 15px;
        margin: 75px 0 0 20px;
        width: 90%;
        height: 68%;

        h3 {
          margin: 3px 0 3px 0;
          font-size: 13px;
          font-weight: bold;
        }
        .content {
          position: relative;
          width: 100%;
          margin-top: 5px;

          input,
          textarea {
            width: 100%;
            padding: 4px;
            border: 1px solid #e0e0e0;
            resize: none;
            outline: none;
            font-size: 11px;
            &::placeholder {
              color: #b9b9b9;
            }
          }
          input[type="submit"] {
            width: 80px;
            background: #24a67f;
            color: #fff;
            border: none;
            cursor: pointer;
            height: 25px;
            font-size: 11px;
          }
        }
      }
    }
  }
}
</style>
