


<div>
    Hi {{ $referral->firstname }} {{ $referral->lastname }}
	<br><br>
    You have been referred by name Surname (email) on the Blythedale Coastal Estate: Refer your Friend on {{ $referral->created_at }}.
    <br><br>
    Do you accept the refferal?
    <br>
    <a href="http://referral.dev/accept/{{ $referral->id }}">YES</a> | <a href="http://referral.dev/decline/{{ $referral->id }}">NO</a>
    <br><br>
    What is bceReferralPortal
    <br>
   <h3> Refer your Friends to Blythedale Coastal Resort and you will receive up to 50% off your site if your referrals purchase a stand at the resort.</h3>

	<p>For every referral that converts into a sale at Blythedale Coastal Resort you will receive 1% discount off your land purchase at Blythedale Coastal Resort up to a maximum of 50% with an additional R5000 per successful referral thereafter (or the corresponding total cash value set at R5000 per successful referral should you decide not to buy at Blythedale Coastal Resort). T&C’s apply</p>
	<br><br>
	Click <a href="http://referral.dev/register">here</a> to register and refer a friend to earn extra cash.
</div>


