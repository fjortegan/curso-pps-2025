from flask import Flask, request, jsonify, make_response
from flask_principal import Principal, Permission, RoleNeed, Identity, AnonymousIdentity, identity_changed, identity_loaded
from flask_login import LoginManager, UserMixin, login_user, logout_user, current_user
app = Flask(__name__)
app.secret_key = 'supersecretkey'

# Configurar Flask-Principal
principals = Principal(app)

# Configurar Flask-Login
login_manager = LoginManager()
login_manager.init_app(app)

# Definir roles y permisos
admin_permission = Permission(RoleNeed('admin'))
user_permission = Permission(RoleNeed('user'))

# Base de datos simulada (puedes cambiarlo por una real)
db_users = {
    "admin": {"password": "admin123", "role": "admin"},
    "user": {"password": "user123", "role": "user"}
}

# Modelo de usuario
class User(UserMixin):
    def __init__(self, username, role):
        self.id = username
        self.role = role

@login_manager.user_loader
def load_user(user_id):
    user_data = db_users.get(user_id)
    if user_data:
        return User(user_id, user_data['role'])
    return None

@app.route('/login', methods=['POST'])
def login():
    data = request.json
    username = data.get("username")
    password = data.get("password")
    user_data = db_users.get(username)
    if user_data and user_data['password'] == password:
        user = User(username, user_data['role'])
        login_user(user)
        identity_changed.send(app, identity=Identity(user.id))
        return jsonify({"message": "Inicio de sesión exitoso"})
    return jsonify({"message": "Credenciales incorrectas"}), 401

3
@app.route('/logout')
def logout():
    logout_user()
    identity_changed.send(app, identity=AnonymousIdentity())

    #Invalidar la cookie de sesión
    response = make_response(jsonify({"message": "Sesión cerrada"}))
    response.set_cookie('session', '', expires=0) # Eliminar la cookie de sesión
    return response

@identity_loaded.connect_via(app)
def on_identity_loaded(sender, identity):
    if current_user.is_authenticated:
        identity.user = current_user
        identity.provides.add(RoleNeed(current_user.role))

@app.route('/admin')
@admin_permission.require(http_exception=403)
def admin_panel():
    return jsonify({"message": "Bienvenido al panel de administración"})

@app.route('/user')
@user_permission.require(http_exception=403)
def user_dashboard():
    return jsonify({"message": "Bienvenido al dashboard de usuario"})

if __name__ == '__main__':
    app.run(debug=True)