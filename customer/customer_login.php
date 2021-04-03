<div class="container-fuild fixed-top">
            <!-- nav -->
                <ul class="nav bg-white cartloc ">
                    <li class="nav-item">
                        <a class="nav-link" onClick="window.history.back()">
                            <i style="font-size: 1.8rem;" class="fas fa-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-1">
                        <h5 class="cart_head">Log in</h5>
                    </li>
                </ul>
            <!-- nav -->

    <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb pt-1">
                <li class="breadcrumb-item active" aria-current="page"><a href="../">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </nav>
    <!-- breadcrumb -->

    </div>
<!-- login form -->
<div class="container">
        <form action="checkout" method="post" class="register_form">
        <div class="form-group" style="margin-top:100px;">
            <div class='input-group'>
                <input type="number"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control" id="c_log_contact" name="c_log_contact" aria-describedby="emailHelp" placeholder="Enter Mobile Number" required >
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="button" id="send_log_otp">Send OTP</button>
                    <button class="btn btn-sm btn-primary d-none" type="button" id="change_log_no">Change</button>
                </div>
            </div>
            <div class="input-group mt-1 d-none" id="otp_log_input">
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" class="form-control py-1" name="c_log_otp" id="c_log_otp" placeholder="Enter OTP" aria-label="Recipient's username" required>
                <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="button" id="otp_log_verify">Verify</button>
                </div>
            </div>
        </div>
        </form>
    </div>
<!-- login form -->

<div class="container px-5">
    <h5 class=" text-center register_link mt-2">Not a Member?</h5>
    <a href="./customer_register" class="btn btnregister_link text-center btn-block p-0">Register Here</a>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="./admin_area/fmr/js/fmr.js"></script>

