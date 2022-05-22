<div>
    <form action="/user" method="POST">
        @csrf
        @method('POST')
        <input id="name"
            type="text"
            class="@error('name') is-invalid @enderror"
            name="name"
        >
        <input id="email"
            type="email"
            class="@error('email') is-invalid @enderror"
            name="email"
        >
        <input id="address"
            type="text"
            class="@error('address') is-invalid @enderror"
            name="address"
        >
        <button type="submit" @disabled($errors->isNotEmpty())>Submit</button>
    </form>
</div>