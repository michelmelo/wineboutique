<h1>New winery registration request.</h1>
<table>
    <tr>
        <th>Name:</th>
        <td>{{ $sellerRegistration->firstName . ' ' . $sellerRegistration->lastName }}</td>
    </tr>
    <tr>
        <th>Company:</th>
        <td>{{ $sellerRegistration->companyName }}</td>
    </tr>
    <tr>
        <th>Email address:</th>
        <td>{{ $sellerRegistration->email }}</td>
    </tr>
    <tr>
        <th>Phone number:</th>
        <td>{{ $sellerRegistration->phone }}</td>
    </tr>
    <tr>
        <th>Job:</th>
        <td>{{ $sellerRegistration->job }}</td>
    </tr>
    <tr>
        <th>No. of brands:</th>
        <td>{{ $sellerRegistration->brands }}</td>
    </tr>
    <tr>
        <th>Shipping:</th>
        <td>{{ $sellerRegistration->shipping === 1 ? "YES" : "NO" }}</td>
    </tr>
    <tr>
        <th>Licences:</th>
        <td><a href="{{ asset($sellerRegistration->licences) }}">Licences</a></td>
    </tr>
</table>