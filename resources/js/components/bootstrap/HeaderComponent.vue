<template>
    <div class="bg-dark-transparent justify-content-center shadow-lg">
        <div class="container">
            <div class="row justify-content-center">
                <ul class="nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle active" href="#" id="offerDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Explore
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Articles</a>
							<a class="dropdown-item" href="#">Events</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Spaces</a>
							<a class="dropdown-item" href="#">Classes</a>
							<a class="dropdown-item" href="#">Tools</a>
						</div>
					</li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle disabled" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Account
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
						</div>
					</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HeaderComponent"
    }
</script>

<style scoped>

</style>
