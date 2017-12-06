    <h1>Welcome to bcePortal</h1>

    <p>Hi {{ $user->name }}, </p>
    	<p>Thanks for becoming a member -- we're excited to have you on board!</p>
    <p>
    <li>Click here to login to your account</li>
    <li>The benifits & features</li>
    <li>Update your profile</li>
    </p>


    <p>{{ $user->name }} - {{ $user->email }} / {{ $user->usertype }} / {{ $user->created_at }} </p>