<!-- Modal para actualizar contraseña -->
<div class="modal fade" id="modalActualizarPwd" tabindex="-1" aria-labelledby="modalActualizarPwdLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActualizarPwdLabel">Actualizar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" autocomplete="off" action="index.php">
                    <input type="hidden" name="accion" value="actualizar_pwd" />

                    <?php if($err_pwd):?>
                        <div class="alert alert-danger" role="alert"><?php echo $err_pwd; ?></div>
                    <?php endif; ?>

                    <input type="password" class="form-control mb-3" name="pwd_actual" placeholder="Contraseña actual" required>
                    <input type="password" class="form-control mb-3" name="pwd_nuevo" placeholder="Nueva contraseña" required>
                    <input type="password" class="form-control mb-4" name="pwd_confirmacion" placeholder="Confirmar nueva contraseña" required>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Guardar Contraseña</button>
                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if($err_pwd): ?>
<script>
    // Si hubo un error, volvemos a abrir el modal automáticamente
    document.addEventListener('DOMContentLoaded', function() {
        var myModal = new bootstrap.Modal(document.getElementById('modalActualizarPwd'));
        myModal.show();
    });
</script>
<?php endif; ?>
