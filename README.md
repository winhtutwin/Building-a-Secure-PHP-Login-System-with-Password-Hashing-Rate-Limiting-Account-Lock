# Building a Secure PHP Login System with Password Hashing, Rate Limiting & Account Lock

အသုံးပြုသူများ Account အသစ်ဖွင့်ခြင်း (Registration) နှင့် ဝင်ရောက်ခြင်း (Login) တို့ကို ပြုလုပ်နိုင်မည့် လုံခြုံစိတ်ချရသော PHP Web Application တစ်ခု ဖြစ်သည်။ Bootstrap 5 ကို အသုံးပြု၍ UI ပြင်ဆင်မှုကို ပြုလုပ်ထားပြီး လုံခြုံရေးအတွက် Bruteforce Attack ကာကွယ်ရေးစနစ် (Account Lockout) ပါဝင်သည်။

## ✨ Features (ပါဝင်သော လုပ်ဆောင်ချက်များ)

* **Secure Registration:** အသုံးပြုသူ အချက်အလက်များကို စစ်ဆေးခြင်း (Validation) နှင့် Password ကို `password_hash()` အသုံးပြု၍ လုံခြုံစွာ သိမ်းဆည်းခြင်း။
* **Secure Authentication:** PDO (PHP Data Objects) အသုံးပြု၍ Prepared Statements များဖြင့် SQL Injection ကို ကာကွယ်ထားခြင်း။
* **Rate Limiting / Account Lockout:** Password (၃) ကြိမ်ထက်ပို၍ မှားယွင်းပါက အကောင့်အား (၁) မိနစ် ယာယီပိတ် (Lock) ထားပြီး Bruteforce တိုက်ခိုက်မှုများကို ကာကွယ်ခြင်း။
* **Session Management:** အကောင့်ဝင်ပြီးသား အသုံးပြုသူများသာ Dashboard သို့ ဝင်ရောက်ခွင့်ပေးခြင်းနှင့် လုံခြုံသော Logout စနစ်။
* **Responsive UI:** Bootstrap 5 Framework ကို အသုံးပြုထားသဖြင့် မိုဘိုင်းလ်နှင့် ကွန်ပျူတာ Screen အားလုံးတွင် စနစ်တကျ ကြည့်ရှုနိုင်ခြင်း။

## 🛠️ Tech Stack (အသုံးပြုထားသော နည်းပညာများ)

* **Backend:** PHP (PDO MySQL)
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Database:** MySQL

## 📋 Database Setup (ဒေတာဘေ့စ် ပြင်ဆင်ခြင်း)

ဤပရောဂျက်တွင် အသင့်အသုံးပြုနိုင်မည့် MySQL database file (`.sql` file) ပါဝင်ပြီးသား ဖြစ်သည်။ ဒေတာဘေ့စ် တည်ဆောက်ရန်-

1. သင့် Local MySQL (phpMyAdmin) ထဲတွင် `registerlogin` အမည်ဖြင့် Database အသစ်တစ်ခု ဆောက်ပါ။
2. အဆိုပါ Database ထဲသို့ ပရောဂျက် Folder ထဲတွင် ပါရှိသော `.sql` ဖိုင်ကို **Import** လုပ်ပေးပါ။

---

## 🚀 Installation & Setup (စက်ထဲတွင် ထည့်သွင်းအသုံးပြုနည်း)

1. **Repository ကို Clone လုပ်ပါ သို့မဟုတ် ဒေါင်းလုဒ်ဆွဲပါ:**
   ```bash
   git clone [https://github.com/winhtutwin/Building-a-Secure-PHP-Login-System-with-Password-Hashing-Rate-Limiting-Account-Lock.git](https://github.com/winhtutwin/Building-a-Secure-PHP-Login-System-with-Password-Hashing-Rate-Limiting-Account-Lock.git)
