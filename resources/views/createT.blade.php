<form action="Routes/web.php" method="GET">
    <div>
        <h2>Creación de tickets</h2>
        <div>
            <div>
                <label>Nombre del ticket</label>
                <div>
                    <input type="text" name="subject" required>
                </div>
            </div>

            <div>
                <label>Estado del ticket</label>
                <div>
                    <select name="hs_ticket_priority" required>
                        <option>HIGH</option>
                        <option>MEDIUM</option>
                        <option>LOW</option>
                    </select>
                </div>

                <div>
                    <label>Estado del ticket</label>
                    <div>
                        <select name="hs_pipeline_stage" required>
                            <option>Nuevo</option>
                            <option>Esperando al comprador</option>
                            <option>Esperando acción por nuestra parte</option>
                            <option>cerrado</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label>Descripción</label>
                    <div>
                        <input type="text" name="content" required>
                    </div>
                </div>

            </div>
            <div>
                <input type="submit" value="Crear ticket">
            </div>
        </div>
    </div>
</form>
