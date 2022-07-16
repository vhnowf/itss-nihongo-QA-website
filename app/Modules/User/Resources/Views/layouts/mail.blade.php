<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
    <div style="max-width:620px;min-width:320px;margin:30px auto;font-family:Helvetica,sans-serif;padding:30px;background:white;color:#424242;border:2px solid #f9f9f9;">
        <p style="text-align:center">
            <a href="{{ route('homes.index') }}" title="logo" target="_blank">
                <img src="https://vinavi.com/images/logo.png" style="width:250px" class="CToWUd">
            </a>
        </p>
        <div style="border:1px solid #f9f9f9;margin:15px auto 8px auto"></div>
        <br>

        <div style="">
            @yield('content')
        </div>

        <div style="border:1px solid #f9f9f9;margin:15px auto 8px auto"></div>
        <br>
        <p>Nếu có vấn đề gì, quý khách vui lòng liên hệ theo số điện thoại <a href="tel:02466566581">0246 6566 581</a> để được hỗ trợ nhanh nhất.</p>
        <p><strong>Trân trọng cám ơn anh chị!</strong></p>
        <div style="border:1px solid #f9f9f9;margin:15px auto 8px auto"></div>
        <br>

        <div style="text-align:center">
            <p style="margin:15px 0"><b>Giữ liên lạc với Vinavi nhé</b></p>
            <p>
                <a href="https://www.facebook.com/vinavi.store" target="_blank">
                    <img src="https://vinavi.com/images/facebook.png" style="max-width:37px;margin:0 5px" class="CToWUd">
                </a>
                <a href="https://www.instagram.com/vinavi.store/" target="_blank">
                    <img src="https://vinavi.com/images/instagram.png" style="max-width:37px;margin:0 5px" class="CToWUd">
                </a>
            </p>
        </div>

        <div style="width:100%;overflow:hidden;text-align:center">
            <p><span style="width:70px;display:inline-block">Địa chỉ:</span>
                <span>Tầng 6, tòa nhà ACCI, số 210 lê trọng tấn, Phường Khương Mai, Quận Thanh Xuân, Hà Nội</span>
            </p>
            <p>
                Email: <a href="mailto:vinavi.store@gmail.com" target="_blank">Vinavi.store@gmail.com</a> 
                - Hotline: <a href="tel:02466566581">0246 6566 581</a>
            </p>

            <br>
            <!-- <div style="width:100%;overflow:hidden;text-align:center">
                <p>
                    Nếu bạn không muốn nhận những email như thế này từ GITIHO trong tương lai.
                    <br>Vui lòng <a style="font-weight:bold" href="#m_8614526008908627234_">hủy đăng ký</a>.
                </p>
            </div> -->
        </div>
    </div>
</body>

</html>
