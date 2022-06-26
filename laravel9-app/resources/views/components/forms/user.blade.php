@php 
    $name = old('name');
    if (!empty($user) && $name == NULL) {
        $name = $user->name;
    }
    $nickname = old('nickname');
    if (!empty($user) && $nickname == NULL) {
        $nickname = $user->nickname;
    }
    $email = old('email');
    if (!empty($user) && $email == NULL) {
        $email = $user->email;
    }
    $address = old('address');
    if (!empty($user) && $address == NULL) {
        $address = $user->address;
    }
@endphp  

Name : <input id="name" value="{{ $name }}" onchange="checkValidate()" type="text" class="@error('name') is-invalid @enderror" name="name" />
@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br />

Nickname : <input id="nickname" value="{{ $nickname }}" type="text" onchange="checkValidate()" class="@error('nickname') is-invalid @enderror" name="nickname" />
@error('nickname')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br />

Email : <input id="email" type="email" value="{{ $email }}" onchange="checkValidate()" class="@error('email') is-invalid @enderror" name="email" />
@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br /> 

Address : <input id="address" type="text" value="{{ $address }}" onchange="checkValidate()" class="@error('address') is-invalid @enderror" name="address" />
@error('address')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<br />
<input type="hidden" value="{{ !empty($user)? $user->id : '' }}" name="id" />

<button type="submit" id="submitbtn" @disabled($errors->isNotEmpty())>Submit</button>    