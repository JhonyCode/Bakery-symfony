### 1. Instalación (En carpeta base del proyecto) ### 

```
docker-compose up -d --build
```

# Los endpoints del proyecto #

| URL | TYPE | DESCRIPTION
| :-------: | :------: | :------:
| localhost:8080/cliente | GET | Obtiene un listado de clientes (Usuarios)
| localhost:8080/cliente/new | POST | Registro de nuevo cliente
| localhost:8080/cliente/{id} | GET | Información completa de un cliente
| localhost:8080/pedido | GET | Listado de pedidos
| localhost:8080/pedido/new | POST | Creación de pedidos 
| localhost:8080/pedido/{id} | GET | Información completa de un pedido
| localhost:8080/producto | GET |Listado de productos
| localhost:8080/producto/new | POST | Creación de productos
| localhost:8080/producto/{id} | GET | Información completa de un producto




