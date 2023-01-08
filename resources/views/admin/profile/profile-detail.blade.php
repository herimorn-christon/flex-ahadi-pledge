  <!-- User Details Page -->
  
  @foreach($profile as $item)

  <!-- Start of User Details -->
<h3 class="profile-username text-center"> {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</h3>

<p class="text-muted text-center">Member</p>

</div>
<strong  class="text-secondary"><i class="fas fa-user-tie mr-1"></i> Full Names</strong>

<p class="text-dark">
    {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}
</p>

<hr>

<strong  class="text-secondary"><i class="fas fa-users mr-1"></i> Community (Jumuiya)</strong>

<p class="text-dark">{{ $item->community->name}}</p>

<hr>

<strong  class="text-secondary"><i class="fas fa-calendar mr-1"></i> Birthdate</strong>

<p class="text-dark">
    {{ $item->date_of_birth}}

</p>

<hr>

<strong class="text-secondary"><i class="fa fa-address-book mr-1 text-secondary"></i> Contacts</strong>

<p class="text-dark">
    {{ $item->phone}}
<br>
    {{ $item->email}}
</p>


@endforeach
