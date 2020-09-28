<div class="col-md-2">
<!--
A ESPERA DE UMA UTILIDADE
Para tabelas com mais campos devemos remover o sidebar da view para deixar uma área maior para os mesmos
-->
    <div class="card">
        <div class="card-header">
            Menu
        </div>

        <div class="card-body">
      @role ('super')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/users') }}">
                        - Users
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/roles') }}">
                        - Roles
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/permissions') }}">
                        - Permissions
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/clients') }}">
                        - Clients
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/products') }}">
                        - Products
                    </a>
                </li>
            </ul>
            <hr>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/register') }}">
                        - Register user
                    </a>
                </li>
            </ul>
      @endrole
      @role('admin')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/users') }}">
                        - Users
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/roles') }}">
                        - Roles
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/permissions') }}">
                        - Permissions
                    </a>
                </li>
            </ul>
      @endrole
      @role('manager')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/clients') }}">
                        - Clients
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/products') }}">
                        - Products
                    </a>
                </li>
            </ul>
      @endrole
      @role('user')
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/clients') }}">
                        - Clients
                    </a>
                </li>
            </ul>
      @endrole
        </div>
    </div>
</div>
