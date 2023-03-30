  <!-- User Details Page -->
  
  @foreach($profile as $item)

  <!-- Start of User Details -->
<h3 class="profile-username text-center"> {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}</h3>

<p class="text-secondary  text-center">Member</p>

</div>
<hr>
<h6 class="text-secondary font-weight-bolder">PERSONAL DETAILS</h6>
<hr>

<strong  class="text-secondary"><i class="fas fa-user-tie mr-1"></i> Full Names</strong>

<p class="text-dark">
    {{ $item->fname}} {{ $item->mname}} {{ $item->lname}}
</p>



<strong  class="text-secondary"><i class="fas fa-users mr-1"></i> Community (Jumuiya)</strong>

<p class="text-dark">{{ $item->community->name}}</p>



<strong  class="text-secondary"><i class="fas fa-calendar mr-1"></i> Birthdate</strong>

<p class="text-dark">
    {{ $item->date_of_birth}}

</p>

<hr>
<h6 class="text-secondary font-weight-bolder">CONTACTS AND ADDRESS</h6>
<hr>
<strong class="text-secondary"><i class="fa fa-address-book mr-1 text-secondary"></i> Contacts</strong>

<p class="text-dark">
    {{ $item->phone}}
<br>
    {{ $item->email}}
</p>
<hr>
<h6 class="text-secondary font-weight-bolder">EDUCATION AND OCCUPATION</h6>
<hr>

<p>Occupation</p>
<p>Place of work
    <strong>
{{ $item->place_of_work }}
    </strong>
</p>
<p>Education</p>
<p>Profession
    <strong>{{ $item->proffession }}</strong>
</p>


<hr>
<h6 class="text-secondary font-weight-bolder">DEPENDANTS INFORMATIONS</h6>
<hr>
<div class="col-md-12">
    <table id="example1" class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>FullNames</th>
                <th>Birthdate</th>
                <th>Relationship</th>
            </tr>
        </thead>

    </table>
</div>
<hr>
<h6 class="text-secondary font-weight-bolder">SPIRITUAL SERVICES</h6>
{{ $item->baptization_date }}
<hr>
@endforeach
