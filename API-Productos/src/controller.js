import {pool} from './database.js';

class ProductoController{

    async getAll(req, res) {
        const [result] = await pool.query('SELECT * FROM productos');
        res.json(result);
    }

    async getOne(req, res) {
        const producto= req.body;
        try {
            const [result] = await pool.query(`SELECT * FROM productos WHERE id_producto=(?)`, [producto.id_producto]);
            if (result.length > 0) {
                res.json({"Datos del producto": result});
            } else {
                res.status(404).json({ "Mensaje": "No se encontró el producto con el ID especificado" });
            }
} catch (error) {
            console.error("Error al buscar el producto por ID:", error);
            res.status(500).json({ "Mensaje": "Error en el servidor" });
        }
    }
    
    async add(req, res){
        const producto = req.body;
        try {
            if (producto.nombre && producto.descripcion && producto.categoria_id && producto.stock && producto.precio){ 
            const [result] = await pool.query(`INSERT INTO productos(nombre,descripcion,categoria_id,stock,precio) VALUES (?,?,?,?,?)`,[producto.nombre, producto.descripcion, producto.categoria_id, producto.stock, producto.precio]);
            res.json({"id insertado": result.insertId})
         }
         else { 
      res.status(404).json ({"Mensaje": "Falta rellenar campos"})
        }
        }
        catch (error) {
            console.error("Error al buscar el producto por ID:", error);
            res.status(500).json({ "Mensaje": "Error en el servidor" });
        }
    }
    async delete(req, res) {
        const producto = req.body;
        try {
            // Comprobar si el producto con el ID especificado existe
            const [result] = await pool.query('SELECT * FROM productos WHERE id_producto = ?', [producto.id_producto]);
    
            if (result.length > 0) {
                // Actualizar el campo "baja" a "si"
                await pool.query('UPDATE productos SET baja = ? WHERE id_producto = ?', ['SI', producto.id_producto]);
    
                res.json({ "Mensaje": "Producto dado de baja" });
            } else {
                res.status(404).json({ "Mensaje": "No se encontró el producto con el ID especificado" });
            }
        } catch (error) {
            console.error("Error al actualizar el campo 'baja' por ID:", error);
            res.status(500).json({ "Mensaje": "Error en el servidor" });
        }
    }
    

    async update(req, res) {

        try {
            const producto = req.body;
            if (producto.id_producto && producto.nombre && producto.descripcion && producto.categoria_id && producto.stock && producto.precio && producto.baja ) {
              const query = `UPDATE productos SET nombre = ?, descripcion = ?, categoria_id = ?, stock = ?, precio = ?, baja= ?  WHERE id_producto = ?`;
              const values = [producto.nombre, producto.descripcion, producto.categoria_id, producto.stock, producto.precio,producto.baja ,producto.id_producto];
              const [result] = await pool.query(query, values);
              if (result.affectedRows === 0) {
                throw { error: "No se encontró ningún producto para actualizar" };
              }
              res.json({ "Registro Actualizado": result.affectedRows });
            } else {
              throw { error: "Faltan campos obligatorios" };
            }
          } catch (error) {
            res.status(400).json(error);
          }
        }
     }
export const producto = new ProductoController(); 